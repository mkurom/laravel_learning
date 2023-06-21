<!DOCTYPE html>
<html lang="ja">

<head>
    <title>Todo List</title>
</head>

<body>
    <h1>Todo List</h1>

    <ul>
        @foreach ($todos as $todo)
            <li>
                <a href="{{ route('todos.show', $todo->id) }}">{{ $todo->title }}</a>
                @if ($todo->completed)
                    <span style="color: green;">(Completed)</span>
                @else
                    <span style="color: red;">(Incomplete)</span>
                @endif

                <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit">
                        @if ($todo->completed)
                            Mark Incomplete
                        @else
                            Mark Complete
                        @endif
                    </button>
                </form>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('todos.create') }}">Create New Todo</a>

</body>

</html>
