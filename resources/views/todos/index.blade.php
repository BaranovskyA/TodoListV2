@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center mb-3">
        <h1>{{ $user->name }}</h1>

        <a href="{{ route('todos.create') }}" class="ml-auto btn btn-success">
            Добавить задачу
        </a>
    </div>

    @forelse($todos as $todo)
        @if($loop->first)
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Статус</th>
                    <th style="width: 100%;" >Заголовок</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
        @endif
                <tr>
                    <td class="p-2 text-center">{{ $todo->id }}</td>
                    <td class="p-2">{{ $todo->status }}</td>
                    <td class="p-0">
                        <a href="{{ route('todos.show', $todo) }}" class="d-block p-2 w-100">
                            {{ $todo->title }}
                        </a>
                    </td class="p-2 text-center">
                    <td class="p-2">
                        <form class="ml-auto" action="{{ route('todos.destroy', $todo) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="btn-group btn-group-sm">
                                @can('update', $todo)
                                <a class="btn btn-info" href="{{ route('todos.edit', $todo) }}">Редактировать</a>
                                @endcan
                                <button class="btn btn-danger">Удалить</button>
                            </div>
                        </form>
                    </td>
                </tr>
        @if($loop->last)
                </tbody>
            </table>
        @endif
    @empty
        <div class="alert alert-secondary">
            Ничего нет :(
        </div>
    @endforelse

    <div class="d-flex justify-content-center">
        {{ $todos->links() }}
    </div>

@endsection
