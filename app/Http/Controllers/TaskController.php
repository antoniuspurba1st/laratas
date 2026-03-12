<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        return view('tasks.index', [
            'tasks' => Task::query()
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('tasks.create', [
            'statuses' => Task::statuses(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Task::query()->create($this->validatedData($request));

        return redirect()
            ->route('tasks.index')
            ->with('status', 'Task created successfully.');
    }

    public function edit(Task $task): View
    {
        return view('tasks.edit', [
            'task' => $task,
            'statuses' => Task::statuses(),
        ]);
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $task->update($this->validatedData($request));

        return redirect()
            ->route('tasks.index')
            ->with('status', 'Task updated successfully.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('status', 'Task deleted successfully.');
    }

    /**
     * Validate request data for task persistence.
     *
     * @return array<string, mixed>
     */
    protected function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:' . implode(',', Task::statuses())],
        ]);
    }
}
