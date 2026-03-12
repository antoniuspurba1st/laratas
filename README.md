# Task Manager

Task Manager is a Laravel 12 starter project for a simple task management application.

This repository currently includes the foundational structure only:

- `Task` Eloquent model
- `tasks` table migration
- Basic task routes
- Project documentation

## Task Schema

The `tasks` table contains:

- `id`
- `title` (`string`, required)
- `description` (`text`, nullable)
- `status` (`enum`: `Pending`, `Completed`)
- `created_at`
- `updated_at`

## Project Structure

- `app/Models/Task.php`: Task domain model
- `database/migrations/2026_03_13_000000_create_tasks_table.php`: Database schema for tasks
- `routes/web.php`: Basic task-related web routes

## Routes

The current routes are placeholders for the task feature:

- `GET /` redirects to `GET /tasks`
- `GET /tasks` returns a basic task index placeholder response
- `GET /tasks/create` returns a basic task creation placeholder response

## Getting Started

1. Install PHP dependencies:

```bash
composer install
```

2. Configure your environment:

```bash
cp .env.example .env
php artisan key:generate
```

3. Update your database settings in `.env`.

4. Run the migrations:

```bash
php artisan migrate
```

5. Start the development server:

```bash
php artisan serve
```

## Notes

CRUD controllers, request validation, views, factories, seeders, and tests have not been added yet.
