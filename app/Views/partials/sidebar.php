<aside class="sidebar" aria-label="Main sidebar">
    <a class="brand" href="<?= esc(site_url('/')) ?>" aria-label="EverTask, Tasks for Today">
        <span class="brand-mark" aria-hidden="true">
            <svg viewBox="0 0 40 40" fill="none"><path d="M20 5c8 6 12 12 12 18a12 12 0 1 1-24 0C8 17 12 11 20 5Z" stroke="currentColor" stroke-width="1.8"/><path d="M14 25c3-5 7-8 13-10M15 27c2 1 5 1 8 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
        </span>
        <span class="brand-copy"><strong>EverTask</strong><small>Tasks for Today</small></span>
    </a>

    <p class="nav-caption">WORKSPACE</p>
    <nav class="side-nav" aria-label="Main navigation">
        <a class="nav-link <?= $activePage === 'today' ? 'is-active' : '' ?>" href="<?= esc(site_url('/')) ?>" <?= $activePage === 'today' ? 'aria-current="page"' : '' ?>>
            <span class="nav-icon" aria-hidden="true">◷</span><span>Today</span>
        </a>
        <a class="nav-link <?= $activePage === 'tasks' ? 'is-active' : '' ?>" href="<?= esc(site_url('tasks')) ?>" <?= $activePage === 'tasks' ? 'aria-current="page"' : '' ?>>
            <span class="nav-icon" aria-hidden="true">▤</span><span>All tasks</span>
        </a>
        <a class="nav-link <?= $activePage === 'profile' ? 'is-active' : '' ?>" href="<?= esc(site_url('profile')) ?>" <?= $activePage === 'profile' ? 'aria-current="page"' : '' ?>>
            <span class="nav-icon" aria-hidden="true">◎</span><span>Profile</span>
        </a>
        <a class="nav-link <?= $activePage === 'about' ? 'is-active' : '' ?>" href="<?= esc(site_url('about')) ?>" <?= $activePage === 'about' ? 'aria-current="page"' : '' ?>>
            <span class="nav-icon" aria-hidden="true">⌘</span><span>About</span>
        </a>
    </nav>

    <div class="sidebar-bottom">
        <div class="sidebar-note"><span class="leaf-dot" aria-hidden="true">✦</span><span>Make room for what matters.</span></div>
        <a class="account-card" href="<?= esc(site_url('profile')) ?>">
            <span class="avatar avatar-small" aria-hidden="true"><?php if ($sidebarUser): ?><?= esc(initials($sidebarUser['full_name'])) ?><?php else: ?>ET<?php endif; ?></span>
            <span class="account-copy"><strong><?= $sidebarUser ? esc($sidebarUser['full_name']) : 'Demo profile' ?></strong><small><?= $sidebarUser ? esc('@' . $sidebarUser['username']) : 'Profile details unavailable' ?></small></span>
            <span class="account-arrow" aria-hidden="true">↗</span>
        </a>
        <form class="logout-form" action="<?= esc(site_url('logout')) ?>" method="post"><?= csrf_field() ?><button type="submit" class="logout-button">Sign out <span aria-hidden="true">↗</span></button></form>
    </div>
</aside>
