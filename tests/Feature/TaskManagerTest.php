<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_root_redirects_to_tasks_index(): void
    {
        $this->get('/')
            ->assertRedirect('/tasks');
    }

    public function test_tasks_index_displays_existing_tasks(): void
    {
        $task = Task::query()->create([
            'title' => 'Prepare project brief',
            'description' => 'Draft the initial project brief.',
            'status' => Task::STATUS_PENDING,
        ]);

        $this->get(route('tasks.index'))
            ->assertOk()
            ->assertSee($task->title)
            ->assertSee($task->status);
    }

    public function test_user_can_create_a_task(): void
    {
        $response = $this->post(route('tasks.store'), [
            'title' => 'Write feature tests',
            'description' => 'Cover CRUD and search flows.',
            'status' => Task::STATUS_PENDING,
        ]);

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'title' => 'Write feature tests',
            'description' => 'Cover CRUD and search flows.',
            'status' => Task::STATUS_PENDING,
        ]);
    }

    public function test_title_is_required_when_creating_a_task(): void
    {
        $response = $this->from(route('tasks.create'))
            ->post(route('tasks.store'), [
                'title' => '',
                'description' => 'Missing title should fail.',
                'status' => Task::STATUS_PENDING,
            ]);

        $response->assertRedirect(route('tasks.create'));
        $response->assertSessionHasErrors('title');
    }

    public function test_status_must_be_valid_when_creating_a_task(): void
    {
        $response = $this->from(route('tasks.create'))
            ->post(route('tasks.store'), [
                'title' => 'Invalid status task',
                'description' => 'Status should be rejected.',
                'status' => 'Archived',
            ]);

        $response->assertRedirect(route('tasks.create'));
        $response->assertSessionHasErrors('status');
    }

    public function test_user_can_update_a_task(): void
    {
        $task = Task::query()->create([
            'title' => 'Initial title',
            'description' => 'Initial description',
            'status' => Task::STATUS_PENDING,
        ]);

        $response = $this->put(route('tasks.update', $task), [
            'title' => 'Updated title',
            'description' => 'Updated description',
            'status' => Task::STATUS_COMPLETED,
        ]);

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated title',
            'description' => 'Updated description',
            'status' => Task::STATUS_COMPLETED,
        ]);
    }

    public function test_user_can_delete_a_task(): void
    {
        $task = Task::query()->create([
            'title' => 'Disposable task',
            'description' => 'This task should be deleted.',
            'status' => Task::STATUS_PENDING,
        ]);

        $response = $this->delete(route('tasks.destroy', $task));

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_tasks_can_be_filtered_by_title_search(): void
    {
        Task::query()->create([
            'title' => 'Laravel documentation review',
            'description' => null,
            'status' => Task::STATUS_PENDING,
        ]);

        Task::query()->create([
            'title' => 'Bootstrap styling pass',
            'description' => null,
            'status' => Task::STATUS_COMPLETED,
        ]);

        $this->get(route('tasks.index', ['search' => 'Laravel']))
            ->assertOk()
            ->assertSee('Laravel documentation review')
            ->assertDontSee('Bootstrap styling pass');
    }

    public function test_tasks_index_is_paginated_with_ten_items_per_page(): void
    {
        foreach (range(1, 11) as $number) {
            Task::query()->create([
                'title' => "Task {$number}",
                'description' => null,
                'status' => Task::STATUS_PENDING,
            ]);
        }

        $response = $this->get(route('tasks.index'));

        $response->assertOk();

        $tasks = $response->viewData('tasks');

        $this->assertSame(10, $tasks->perPage());
        $this->assertSame(11, $tasks->total());
        $this->assertCount(10, $tasks->items());
    }
}
