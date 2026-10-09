<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="page-intro"><p class="eyebrow eyebrow-dark">A LITTLE ABOUT YOUR WORKSPACE</p><h2>Your profile</h2><p>Your account details and activity in this workspace.</p></section>
<?php if ($user === null): ?>
    <section class="empty-state profile-empty"><span class="empty-icon" aria-hidden="true">◎</span><h3>Profile record not found</h3><p>Import the supplied database file to load the single demo user.</p></section>
<?php else: ?>
    <section class="profile-card" aria-labelledby="profile-name">
        <div class="profile-banner"><span class="profile-orb orb-a" aria-hidden="true"></span><span class="profile-orb orb-b" aria-hidden="true"></span><span class="profile-label">EVERTASK · PERSONAL WORKSPACE</span></div>
        <div class="profile-content">
            <div class="profile-identity"><span class="avatar avatar-large" aria-hidden="true"><?= esc(initials($user['full_name'])) ?></span><div><span class="demo-pill"><?= esc(ucfirst($user['role'] ?? 'member')) ?> account</span><h2 id="profile-name"><?= esc($user['full_name']) ?></h2><p>@<?= esc($user['username']) ?></p></div></div>
            <div class="profile-details">
                <div class="detail-item"><span class="detail-label">Email address</span><strong><?= esc($user['email']) ?></strong></div>
                <div class="detail-item"><span class="detail-label">Account created</span><strong><?= esc(date('F j, Y', strtotime($user['created_at']))) ?></strong></div>
            </div>
            <div class="profile-stats"><div><strong><?= esc((string) $taskTotal) ?></strong><span>Total tasks</span></div><div><strong><?= esc((string) $todayTotal) ?></strong><span>For today</span></div><div><strong><?= esc((string) $counts['completed']) ?></strong><span>Completed</span></div></div>
        </div>
    </section>
    <form class="profile-signout" action="<?= esc(site_url('logout')) ?>" method="post"><?= csrf_field() ?><button class="button button-quiet" type="submit">Sign out</button></form>
<?php endif; ?>
<?= $this->endSection() ?>
