# Task Manager App

A simple Task Manager application that allows users to manage tasks with different categories, priorities, statuses, and due dates. The app provides features for authentication, task management, task status updates, and generating reports.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)

## Features

- **User Authentication:** Register and login/logout functionality.
- **Task Management:** Add, edit, delete, and update the status of tasks.
- **Task Search:** Search tasks by title, category, or status.
- **Reports:** View task reports for performance analysis.
- **Category Management:** Add, edit, and delete categories for task classification.

## Requirements

- PHP 7.x or higher
- MySQL or compatible database
- Web server (Apache or Nginx)
- Composer (optional)

## Installation

1. Clone the repository:

```bash
git clone https://github.com/your-username/task-manager.git
cd task-manager
```

2. Set up the database:

Create a MySQL database and import `task_manager_pro.sql`. Configure credentials in `config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'your-password');
define('DB_NAME', 'task_manager_pro');
```

3. Install dependencies (optional):

```bash
composer install
```

4. Configure .htaccess (for Apache):

```
RewriteEngine On
RewriteBase /task-manager/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]
```

5. Run the app:

Go to `http://localhost/task-manager/public/index.php`

## File Structure

```
task-manager/
├── controllers/
│   ├── UserController.php
│   ├── TaskController.php
│   └── CategoryController.php
├── models/
│   ├── User.php
│   ├── Task.php
│   └── Category.php
├── views/
│   ├── add_category.php
│   ├── add_task.php
│   ├── catagory_list.php
│   ├── edit_catagory.php
│   ├── edit_task.php
│   ├── error.php
│   ├── login.php
│   ├── nav.php
│   ├── register.php
│   ├── report.php
│   ├── search_tasks.php
│   └── task_list.php
├── public/
│   └── index.php
├── config.php
└── assets/
```

## Usage

### Task Management

- **Add a task:** Use "+ Add Task" to enter title, description, priority, and due date.
- **Edit a task:** Click "Edit" to update task details.
- **Change status:** Mark as Todo, In Progress, or Done.
- **Delete a task:** Use "Delete" with confirmation.

### Authentication

- **Register:** Create an account.
- **Login:** Sign in.
- **Logout:** Ends the session.

### Reports

- View status breakdown and overdue task counts.

### Search

- Filter tasks by keyword, category, priority, or status.

## Troubleshooting

- Check database connection and tables.
- Ensure `.htaccess` works for URL rewriting.

## Contributing

Contributions are welcome!

```bash
git checkout -b feature-name
git commit -am "Add feature"
git push origin feature-name
```

Then open a pull request.

## License

This project is licensed under the MIT License.
