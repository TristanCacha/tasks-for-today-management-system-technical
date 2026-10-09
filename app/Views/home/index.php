<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="hero-card" aria-labelledby="welcome-title">
    <div class="hero-copy">
        <p class="hero-kicker"><span class="pulse-dot" aria-hidden="true"></span> YOUR SPACE TO RESET AND FOCUS</p>
        <h2 id="welcome-title"><?= esc($greeting) ?><?php if ($sidebarUser): ?>, <?= esc(explode(' ', $sidebarUser['full_name'])[0]) ?><?php endif; ?>.</h2>
        <p class="hero-description">Here’s what deserves your attention today. Take it one thoughtful step at a time.</p>
        <div class="hero-actions">
            <a class="button button-primary" href="<?= esc(site_url('tasks')) ?>">View all tasks <span aria-hidden="true">↗</span></a>
            <span class="hero-date"><?= esc($todayLabel) ?></span>
        </div>
    </div>
    <div class="hero-art" aria-hidden="true">
        <span class="hero-orbit orbit-one"></span><span class="hero-orbit orbit-two"></span>
        <span class="hero-leaf leaf-large"></span><span class="hero-leaf leaf-small"></span>
        <span class="hero-art-caption">a calmer kind<br>of productivity</span>
    </div>
</section>

<?= $this->include('partials/summary_cards') ?>

<section class="section-block" aria-labelledby="today-tasks-heading">
    <div class="section-heading">
        <div><p class="eyebrow eyebrow-dark">A CLEAR VIEW OF YOUR DAY</p><h2 id="today-tasks-heading">Today’s focus</h2></div>
        <a class="text-link" href="<?= esc(site_url('tasks')) ?>">See all tasks <span aria-hidden="true">→</span></a>
    </div>

    <?php if ($tasks === []): ?>
        <div class="empty-state"><span class="empty-icon" aria-hidden="true">✦</span><h3>A little breathing room</h3><p>No tasks are scheduled for today. Your next step is yours to choose.</p></div>
    <?php else: ?>
        <div class="task-list" role="list">
            <?php foreach ($tasks as $task): ?>
                <article class="task-row <?= $task['status'] === 'completed' ? 'task-row-done' : '' ?>" role="listitem">
                    <form class="task-toggle-form" action="<?= esc(site_url("tasks/{$task['id']}/toggle")) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="return_to" value="home">
                        <button class="task-check <?= $task['status'] === 'completed' ? 'is-done' : '' ?>" type="submit" aria-label="<?= $task['status'] === 'completed' ? 'Mark incomplete: ' : 'Mark complete: ' ?><?= esc($task['title']) ?>"><?= $task['status'] === 'completed' ? '✓' : '' ?></button>
                    </form>
                    <div class="task-main"><h3><?= esc($task['title']) ?></h3><p>Added <?= esc(date('M j · g:i a', strtotime($task['created_at']))) ?></p></div>
                    <?= $this->include('partials/status_badge', ['status' => $task['status']]) ?>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection() ?>
