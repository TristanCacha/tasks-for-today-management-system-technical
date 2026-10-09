<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="page-intro"><div><p class="eyebrow eyebrow-dark">YOUR PLANS, IN ONE PLACE</p><h2>All tasks</h2><p>Every planned step, arranged by date so the next thing is easy to find.</p></div><a class="button button-primary" href="<?= esc(site_url('tasks/new')) ?>">Add a task <span aria-hidden="true">＋</span></a></section>
<?= $this->include('partials/summary_cards') ?>

<section class="section-block task-section" aria-labelledby="all-tasks-heading">
    <div class="section-heading"><div><p class="eyebrow eyebrow-dark">TASK OVERVIEW</p><h2 id="all-tasks-heading">Your schedule</h2></div><span class="record-count"><?= esc((string) $totalTasks) ?> <?= $totalTasks === 1 ? 'task' : 'tasks' ?></span></div>
    <?php if ($tasks === []): ?>
        <div class="empty-state"><span class="empty-icon" aria-hidden="true">✦</span><h3>No tasks yet</h3><p>Add your first task and it will appear here in date order.</p><a class="button button-primary" href="<?= esc(site_url('tasks/new')) ?>">Add a task</a></div>
    <?php else: ?>
        <div class="table-wrap">
            <table class="task-table">
                <caption class="sr-only">All task records sorted by scheduled date</caption>
                <thead><tr><th scope="col">Task</th><th scope="col">Status</th><th scope="col">Scheduled</th><th scope="col">Added</th><th scope="col">Actions</th></tr></thead>
                <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <th scope="row"><span class="table-task-title"><?= esc($task['title']) ?></span><span class="table-task-id">Task #<?= esc((string) $task['id']) ?></span></th>
                        <td><?= $this->include('partials/status_badge', ['status' => $task['status']]) ?></td>
                        <td><?= esc(date('M j, Y', strtotime($task['task_date']))) ?></td>
                        <td><?= esc(date('M j, Y · g:i a', strtotime($task['created_at']))) ?></td>
                        <td class="task-actions"><a class="button button-small" href="<?= esc(site_url("tasks/{$task['id']}/edit")) ?>">Edit</a><form action="<?= esc(site_url("tasks/{$task['id']}/delete")) ?>" method="post" data-confirm="Delete this task? This cannot be undone."><?= csrf_field() ?><button class="button button-small button-danger" type="submit">Delete</button></form></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="mobile-task-list" role="list">
            <?php foreach ($tasks as $task): ?>
                <article class="mobile-task-card" role="listitem">
                    <div class="mobile-task-top"><span class="task-date-chip"><?= esc(date('M j', strtotime($task['task_date']))) ?></span><?= $this->include('partials/status_badge', ['status' => $task['status']]) ?></div>
                    <h3><?= esc($task['title']) ?></h3><p>Scheduled <?= esc(date('l, M j, Y', strtotime($task['task_date']))) ?></p>
                    <small>Added <?= esc(date('M j, Y · g:i a', strtotime($task['created_at']))) ?></small>
                    <div class="mobile-task-actions"><a class="button button-small" href="<?= esc(site_url("tasks/{$task['id']}/edit")) ?>">Edit</a><form action="<?= esc(site_url("tasks/{$task['id']}/delete")) ?>" method="post" data-confirm="Delete this task? This cannot be undone."><?= csrf_field() ?><button class="button button-small button-danger" type="submit">Delete</button></form></div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection() ?>
