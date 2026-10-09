<nav class="mobile-nav" aria-label="Mobile navigation">
    <a class="mobile-nav-link <?= $activePage === 'today' ? 'is-active' : '' ?>" href="<?= esc(site_url('/')) ?>" <?= $activePage === 'today' ? 'aria-current="page"' : '' ?>><span aria-hidden="true">◷</span><small>Today</small></a>
    <a class="mobile-nav-link <?= $activePage === 'tasks' ? 'is-active' : '' ?>" href="<?= esc(site_url('tasks')) ?>" <?= $activePage === 'tasks' ? 'aria-current="page"' : '' ?>><span aria-hidden="true">▤</span><small>Tasks</small></a>
    <a class="mobile-nav-link <?= $activePage === 'profile' ? 'is-active' : '' ?>" href="<?= esc(site_url('profile')) ?>" <?= $activePage === 'profile' ? 'aria-current="page"' : '' ?>><span aria-hidden="true">◎</span><small>Profile</small></a>
    <a class="mobile-nav-link <?= $activePage === 'about' ? 'is-active' : '' ?>" href="<?= esc(site_url('about')) ?>" <?= $activePage === 'about' ? 'aria-current="page"' : '' ?>><span aria-hidden="true">⌘</span><small>About</small></a>
</nav>
