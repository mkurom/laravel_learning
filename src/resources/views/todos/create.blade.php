<!DOCTYPE html>
<html>

<head>
    <title>Create Todo</title>
</head>

<body>
    <h1>Create Todo</h1>

    <form action="{{ route('todos.store') }}" method="POST">
        @csrf

        <label for="title">Title:</label>
        <input type="text" name="title" id="title">

        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>

        <button type="submit">Create</button>
    </form>
</body>

</html>
