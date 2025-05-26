<?php include __DIR__ . '/nav.php'; ?>

<h2>📝 Your Tasks</h2>

<p><strong>Sort by:</strong>
    <a href="?action=tasks&sort=priority">Priority</a> |
    <a href="?action=tasks&sort=due_date">Due Date</a> |
    <a href="?action=tasks&sort=status">Status</a>
</p>

<?php if (!empty($tasks)): ?>
    <ul>
    <?php foreach ($tasks as $task): ?>
        <li style="margin-bottom:20px;">
            <strong><?= htmlspecialchars($task['title']) ?></strong><br>

            <?php if (!empty($task['description'])): ?>
                <?= htmlspecialchars($task['description']) ?><br>
            <?php endif; ?>

            Category: <?= htmlspecialchars($task['category_name'] ?? 'None') ?><br>
            Priority: <?= htmlspecialchars($task['priority']) ?><br>
            Due: <?= $task['due_date'] ?: 'N/A' ?><br>
            Status: <?= htmlspecialchars($task['status']) ?><br>

            <a href="?action=edit_task&id=<?= $task['id'] ?>">✏️ Edit</a> |
            <a href="?action=delete&id=<?= $task['id'] ?>" onclick="return confirm('Delete this task?')">🗑 Delete</a> |

            <?php foreach (['todo', 'in_progress', 'done✅'] as $status): ?>
                <?php if ($task['status'] !== $status): ?>
                    <a href="?action=setStatus&id=<?= $task['id'] ?>&status=<?= $status ?>">
                        Mark <?= ucfirst(str_replace('_', ' ', $status)) ?>
                    </a> |
                <?php endif; ?>
            <?php endforeach; ?>
        </li>
        <hr>
    <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No tasks found.</p>
<?php endif; ?>
<?php include __DIR__ . '/nav.php'; ?>
