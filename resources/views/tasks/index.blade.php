<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
        }

        .header,
        .task-actions,
        .flash-message {
            margin-bottom: 1rem;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #d0d7de;
            padding: 0.75rem;
            text-align: left;
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Task Manager</h1>
        <a href="{{ route('tasks.create') }}">Create Task</a>
    </div>

    @if (session('status'))
        <div class="flash-message">{{ session('status') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description ?: 'No description' }}</td>
                    <td>{{ $task->status }}</td>
                    <td class="task-actions">
                        <a href="{{ route('tasks.edit', $task) }}">Edit</a>

                        <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No tasks available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
