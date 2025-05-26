<!-- views/report.php -->
 <?php include __DIR__ . '/nav.php'; ?>

<h2>📊 Task Report</h2>

<h3>Status Breakdown</h3>
<ul>
    <li>🕓 Todo: <?= $statusCounts['todo'] ?? 0 ?></li>
    <li>⚙️ In Progress: <?= $statusCounts['in_progress'] ?? 0 ?></li>
    <li>✅ Done: <?= $statusCounts['done'] ?? 0 ?></li>
</ul>

<h3>⚠️ Overdue Tasks</h3>
<p><?= $overdue ?> task(s) are overdue.</p>

<h3>📁 Category Summary</h3>
<ul>
<?php foreach ($categorySummary as $row): ?>
    <li>
        <?= htmlspecialchars($row['name']) ?>:
        <?= $row['total'] ?> total,
        <?= $row['completed'] ?> done
    </li>
<?php endforeach; ?>
</ul>

<?php include __DIR__ . '/nav.php'; ?>
