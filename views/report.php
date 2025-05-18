<h2>📊 Task Report</h2>

<h3>Status Overview</h3>
<ul>
    <li>Todo: <?= $statusCounts['todo'] ?? 0 ?></li>
    <li>In Progress: <?= $statusCounts['in_progress'] ?? 0 ?></li>
    <li>Done: <?= $statusCounts['done'] ?? 0 ?></li>
</ul>

<h3>Overdue Tasks</h3>
<p>❗ You have <?= $overdueCount ?> overdue task(s).</p>

<h3>Category Summary</h3>
<table border="1" style="width:50%; border-collapse:collapse;">
    <thead>
        <tr><th>Category</th><th>Total Tasks</th><th>Done</th></tr>
    </thead>
    <tbody>
        <?php foreach ($categorySummary as $cat): ?>
        <tr>
            <td><?= htmlspecialchars($cat['name']) ?></td>
            <td><?= $cat['total'] ?></td>
            <td><?= $cat['done'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
