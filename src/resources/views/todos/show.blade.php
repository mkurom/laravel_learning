<!DOCTYPE html>
<html>

<head>
    <title>Todo Details</title>
</head>

<body>
    <h1>Todo Details</h1>

    <h2>Title: {{ $todo->title }}</h2>
    <p>Description: {{ $todo->description }}</p>
    <p>Status: {{ $todo->completed ? 'Completed' : 'Incomplete' }}</p>
    <p>Created At: {{ $todo->created_at }}</p>
    <p>Updated At: {{ $todo->updated_at }}</p>
</body>

</html>
