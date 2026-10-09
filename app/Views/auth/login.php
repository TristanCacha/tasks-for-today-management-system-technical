<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>
<p class="auth-kicker">WELCOME BACK</p><h1>Sign in to EverTask</h1><p class="auth-description">Pick up where you left off and make room for what matters.</p>
<?php if ($message = session()->getFlashdata('authError')): ?><div class="flash-message flash-error" role="alert"><?= esc($message) ?></div><?php endif; ?>
<form class="auth-form" action="<?= esc(site_url('login')) ?>" method="post">
    <?= csrf_field() ?>
    <label for="username">Username</label><input id="username" name="username" type="text" autocomplete="username" value="<?= esc(old('username') ?? '') ?>" required autofocus>
    <label for="password">Password</label><input id="password" name="password" type="password" autocomplete="current-password" required>
    <button class="button button-primary auth-submit" type="submit">Sign in <span aria-hidden="true">→</span></button>
</form>
<p class="auth-footnote">Your workspace is private. <span>Passwords are stored as secure hashes.</span></p>
<?= $this->endSection() ?>
