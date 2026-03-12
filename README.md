# Laravel Task Manager

## Project Overview

Laravel Task Manager is a simple task management system built with Laravel and Bootstrap 4. It provides a straightforward interface for managing tasks through core CRUD operations, allowing users to create, view, update, and delete tasks from a centralized dashboard.

The application is designed to keep task tracking lightweight and easy to maintain. It supports task status management and is structured to accommodate task search and list filtering as part of the overall workflow.

## Features

- Create tasks with title, description, and status
- View a list of tasks
- Edit existing tasks
- Delete tasks with confirmation
- Mark tasks as Completed or Pending
- Pagination for task list
- Search tasks by title
- Form validation
- Bootstrap UI styling
- Feature tests for task manager flows

## Setup Instructions

1. Clone the repository:

```bash
git clone <repository-url>
cd laratas
```

2. Install PHP dependencies with Composer:

```bash
composer install
```

3. Create your environment file and generate the application key:

```bash
cp .env.example .env
php artisan key:generate
```

## Database Setup

Update the `.env` file with your local database credentials. At minimum, configure the following values:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=
```

After the database configuration is complete, run the migrations:

```bash
php artisan migrate
```

This will create the required tables for the application, including the `tasks` table used by the task manager.

## Running the Application

Start the local development server with:

```bash
php artisan serve
```

Once the server is running, open the local URL shown in your terminal, typically:

```text
http://127.0.0.1:8000
```

## Running Tests

Run the automated test suite with:

```bash
php artisan test
```

## Technologies Used

- Laravel
- PHP
- Bootstrap 4
- MySQL
- Eloquent ORM
- Git

## Assumptions

- The project is intended to run in a standard local Laravel development environment with PHP, Composer, and MySQL installed.
- Bootstrap 4 is used for the UI layer through CDN-based styling in the Blade views.
- Task status is limited to two valid values: `Pending` and `Completed`.
- Search is part of the expected application scope and is assumed to be implemented through task title filtering in the task list workflow.
- The application is designed for basic single-project task management and does not currently assume multi-user authentication or authorization requirements.

## Bonus Features

- Search functionality for tasks
- Pagination for task list
- Automated feature test coverage

## Submission Notes

This project is structured to follow Laravel conventions for models, migrations, controllers, routes, and Blade templates. The codebase is intentionally simple and suitable for extension with additional features such as authentication, task categories, due dates, and richer filtering in future iterations.
