<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $todos = $user->todos()->paginate(5);
        return view('todos.index', compact('user', 'todos'));
    }

    public function create()
    {
        $this->authorize('create', Todo::class);
        return view('todos.form');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Todo::class);
        $data = $this->validated($request);

        /** @var HasMany $todos */
        $todo = auth()->user()->todos();
        $new = $todo->create($data);

        return redirect()->route('todos.show', $new);
    }

    public function show(Todo $todo)
    {
        $this->authorize('view', $todo);
        return view('todos.show', compact('todo'));
    }

    public function edit(Todo $todo)
    {
        $this->authorize('update', $todo);
        return view('todos.form', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $this->authorize('update', $todo);
        $data = $this->validated($request, $todo);

        $todo->update($data);
        return redirect()->route('todos.show', $todo);
    }

    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);
        $todo->delete();
        return redirect()->route('todos.index');
    }

    public function toggle(Todo $todo)
    {
        $this->authorize('update', $todo);
        $todo->done = !$todo->done;
        $todo->save();
        return redirect()->route('todos.show', $todo);
    }

    protected function validated(Request $request, Todo $todo = null) {
        $rules = [
            'title' => 'required|min:5|max:100|unique:todos',
            'description' => 'nullable',
            'done' => 'boolean',
            'status' => 'required|status'
        ];

        if($todo)
            $rules['title'] .= ',title,' . $todo->id;

        return $request->validate($rules, [
                'status' => 'Status doesn\'t match'
        ]);
    }
}
