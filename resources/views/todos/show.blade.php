@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center flex-wrap">
        <h1>
            {{ $todo->title }}
            @if($todo->isComplete())

            @endif
        </h1>

        <form class="ml-auto" action="{{ route('todos.destroy', $todo) }}" method="POST">
            @csrf
            @method('DELETE')

            @can('update', $todo)
                <a href="{{ route('todos.toggle', $todo) }}" class="btn {{ $todo->done ? 'btn-success' : 'btn-secondary' }}">
                    {{ Str::of(($todo->done ? '' : 'не ') . 'выполнено')->lower()->ucfirst() }}
                </a>
            @endcan

            <div class="btn-group">
                @can('update', $todo)
                    <a class="btn btn-info" href="{{ route('todos.edit', $todo) }}">Редактировать</a>
                @endcan
                @can('delete', $todo)
                    <button class="btn btn-danger">Удалить</button>
                @endcan
            </div>
        </form>
    </div>

    <div class="lead text-muted">
        {{ $todo->user->name }},
        {{ $todo->created_at->diffForHumans( ) }}
    </div>

    <div class="mb-3"></div>

    <div class="card card-body">
        <div class="text-muted mb-3">{{ $todo->status }}</div>
        <p class="lead mb-0">{{ $todo->description }}</p>
    </div>
@endsection
