Task Manager App
A simple Task Manager application that allows users to manage tasks with different categories, priorities, statuses, and due dates.

Features
User Authentication: Register and login/logout functionality.

Task Management: Add, edit, delete, and update the status of tasks.

Task Search: Search tasks by title, category, or status.

Reports: View task reports for performance analysis.

Category Management: Add and list categories for task classification.

Requirements
PHP 7.x or higher

MySQL or any compatible database

A web server like Apache or Nginx

Composer (optional for autoloading)

Installation
Clone the repository:

bash
Copy
Edit
git clone https://github.com/your-username/task-manager.git
cd task-manager
Set up the database:

Create a new MySQL database and configure it in config.php or the database settings inside your controllers.

Example:

php
Copy
Edit
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'your-password');
define('DB_NAME', 'task_manager');
Install dependencies (optional):

If you're using Composer, run the following command to install necessary dependencies:

bash
Copy
Edit
composer install
Configure the .htaccess file (for Apache):

If using Apache, make sure you have a .htaccess file in your root directory for URL rewriting.

Example .htaccess:

perl
Copy
Edit
RewriteEngine On
RewriteBase /task-manager/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]
Run the app:

Open your browser and navigate to http://localhost/task-manager/public/index.php

Log in or register a new user, and start managing your tasks.

File Structure
bash
Copy
Edit
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
Usage
Task Management
Adding a Task:

Navigate to the task list page and click on + Add Task.

Fill in the task details such as title, description, priority, and due date.

Editing a Task:

From the task list, click on Edit next to any task to update its details.

Changing Status:

Mark tasks as Todo, In Progress, or Done by clicking on the respective status link.

Deleting a Task:

Delete tasks from the task list by clicking on Delete. A confirmation will appear before the task is deleted.

User Authentication
Register: New users can create an account via the registration page.

Login: Log in using registered credentials.

Logout: Users can log out to end the session.

Reports
View a task performance report by navigating to the 📈 View Task Report section.

Search
Use the search functionality to find tasks by title, category, or status.

Troubleshooting
If you're facing issues with the app, make sure the database configuration is correct and the necessary tables exist.

Ensure that the PHP server is running and the .htaccess file is properly configured for URL rewriting.

Contributing
Contributions are welcome! If you'd like to improve this project, feel free to open a pull request or create an issue.

Fork the repository.

Create a new branch (git checkout -b feature-name).

Commit your changes (git commit -am 'Add feature').

Push to the branch (git push origin feature-name).

Create a new pull request.

License
This project is open-source and available under the MIT License.