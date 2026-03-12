<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
        }

        form {
            display: grid;
            gap: 1rem;
            max-width: 36rem;
        }

        label {
            display: grid;
            gap: 0.5rem;
        }

        .errors {
            color: #b91c1c;
        }
    </style>
</head>
<body>
    <h1>Create Task</h1>
    <p><a href="{{ route('tasks.index') }}">Back to tasks</a></p>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <label>
            Title
            <input type="text" name="title" value="{{ old('title') }}" required>
        </label>

        <label>
            Description
            <textarea name="description" rows="5">{{ old('description') }}</textarea>
        </label>

        <label>
            Status
            <select name="status" required>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" @selected(old('status', \App\Models\Task::STATUS_PENDING) === $status)>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </label>

        <button type="submit">Save Task</button>
    </form>
</body>
</html>
