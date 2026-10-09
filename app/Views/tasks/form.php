<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="page-intro"><p class="eyebrow eyebrow-dark">MAKE A PLAN THAT FITS YOUR DAY</p><h2><?= esc($title) ?></h2><p>Add a task or update its title, date, and progress.</p></section>
<?php if ($errors !== []): ?><div class="form-errors" role="alert"><?php foreach ($errors as $error): ?><p><?= esc($error) ?></p><?php endforeach; ?></div><?php endif; ?>
<form class="task-editor" action="<?= esc($formAction) ?>" method="post">
    <?= csrf_field() ?>
    <label for="title">Task title</label><input id="title" name="title" type="text" maxlength="150" value="<?= esc(old('title') ?? $task['title']) ?>" required autofocus>
    <div class="form-grid"><div><label for="task_date">Scheduled date</label><input id="task_date" name="task_date" type="date" value="<?= esc(old('task_date') ?? $task['task_date']) ?>" required></div>
    <?php if (isset($task['id'])): ?><div><label for="status">Status</label><select id="status" name="status"><option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>Pending</option><option value="in_progress" <?= $task['status'] === 'in_progress' ? 'selected' : '' ?>>In progress</option><option value="completed" <?= $task['status'] === 'completed' ? 'selected' : '' ?>>Completed</option></select></div><?php endif; ?></div>
    <div class="form-actions"><a class="button button-quiet" href="<?= esc(site_url('tasks')) ?>">Cancel</a><button class="button button-primary" type="submit"><?= isset($task['id']) ? 'Save changes' : 'Add task' ?> <span aria-hidden="true">→</span></button></div>
</form>
<?= $this->endSection() ?>
