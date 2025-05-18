# Task Manager App

A simple Task Manager application that allows users to manage tasks with different categories, priorities, statuses, and due dates. The app provides features for authentication, task management, task status updates, and generating reports.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)


## Features

- **User Authentication:** Register and login/logout functionality.
- **Task Management:** Add, edit, delete, and update the status of tasks.
- **Task Search:** Search tasks by title, category, or status.
- **Reports:** View task reports for performance analysis.
- **Category Management:** Add and list categories for task classification.

## Requirements

- PHP 7.x or higher
- MySQL or any compatible database
- Web server (Apache or Nginx)
- Composer (optional for autoloading)

## Installation

### 1. Clone the repository:

```bash
git clone https://github.com/your-username/task-manager.git
cd task-manager
```

### 2. Set up the datase:

Create a new MySQL database and configure the database settings inside your project. You can find the database configuration settings in the config.php file or inside the controllers.

Example database configuration in config.php:

```bash 
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'your-password');
define('DB_NAME', 'task_manager');
```

### 3. Install dependencies (optianlal):

If you're using Composer, run the following command to install the necessary dependencies:

```bash
composer install
```

### 4. Configure .htaccess file (for Apache):

If using Apache, ensure you have a .htaccess file for URL rewriting.

Example .htaccess file:

```bash
RewriteEngine On
RewriteBase /task-manager/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]
```

### 5. Run the application:

- Open your browser and navigate to http://localhost/task-manager/public/index.php
- Log in or register a new user, and start managing your tasks.

## File Structure

```bash
/task-manager
├── /controllers         # Controllers for handling app logic
│   ├── UserController.php
│   ├── TaskController.php
│   └── CategoryController.php
├── /models              # Models for database interaction
│   ├── User.php
│   ├── Task.php
│   └── Category.php
├── /views               # HTML templates
│   ├── task_list.php
│   ├── login.php
│   ├── register.php
│   └── error.php
├── /public              # Public assets
│   └── index.php        # Main entry point
├── /config              # Configuration files
│   └── config.php
└── /assets              # Static files (CSS, images)
```

## Usage

### Task Management
#### 1. ADding a task:
- Navigate to the task list page and click on ```+ Add Task```.
- Fill in the task details such as title, description, priority, and due date.

#### Editing a Task:
- From the task list, click on ```Edit``` next to any task to update its details.

#### Changing Status:
- Mark tasks as ```Todo```, ```In Progress```, or ```Done``` by clicking on the respective status link.

#### Deleting a Task:
- Delete tasks from the task list by clicking on ```Delete```. A confirmation will appear before the task is deleted.

### User Authentication
- **Register:** New users can create an account via the registration page.
- **Login:** Log in using registered credentials.
- **Logout:** Users can log out to end the session.

### Reports
- View task performance reports by navigating to the ```📈 View Task Report``` section.

### Search
- Use the search functionality to find tasks by title, category, or status.

### Troubleshooting
- Ensure your database is properly configured and the required tables exist.
- Make sure the PHP server is running, and the ```.htaccess``` file is set up for URL rewriting.

## Contributing
Contributions are welcome! If you'd like to improve this project, feel free to open a pull request or create an issue.

- 1. Fork the repository.
- 2. Create a new branch (```bash git checkout -b feature-name ```).
- 3. Commit your changes (```git commit -am 'Add feature'```).
- 4. Push to the branch (```git push origin feature-name```).
- 5. Create a new pull request.

## License
This project is open-source and available under the MIT License.


