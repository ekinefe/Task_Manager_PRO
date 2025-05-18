<!-- views/task_list.php -->
<h2>Your Tasks</h2>

<a href="index.php?action=add_task">+ Add Task</a> |
<a href="index.php?action=search">🔍 Search Tasks</a> |
<a href="index.php?action=report">📈 View Task Report</a> |
<a href="index.php?action=logout">🚪 Logout</a>

<?php if (empty($tasks)): ?>
    <p>No tasks found. Add a task to get started!</p>
<?php else: ?>
<table border="1" style="width:100%; border-collapse:collapse; margin-top:15px; text-align:left;">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Priority</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Actions</th> 
        </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= htmlspecialchars($task['title']) ?></td>
            <td><?= $task['description'] ? htmlspecialchars($task['description']) : '-' ?></td>
            <td><?= $task['category_name'] ? htmlspecialchars($task['category_name']) : '-' ?></td>
            <td><?= ucfirst(htmlspecialchars($task['priority'])) ?></td>
            <td><?= $task['due_date'] ? htmlspecialchars($task['due_date']) : '-' ?></td>
            <td><?= htmlspecialchars($task['status']) ?></td>
            <td>
                <a href="index.php?action=edit&id=<?= $task['id'] ?>">Edit</a> |
                <a href="index.php?action=setStatus&id=<?= $task['id'] ?>&status=todo">Todo</a> |
                <a href="index.php?action=setStatus&id=<?= $task['id'] ?>&status=in_progress">In Progress</a> |
                <a href="index.php?action=setStatus&id=<?= $task['id'] ?>&status=done">Done</a> |
                <a href="index.php?action=delete&id=<?= $task['id'] ?>" onclick="return confirm('Are you sure you want to delete this task?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
