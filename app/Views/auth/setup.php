<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>
<p class="auth-kicker">FIRST-TIME SETUP</p><h1>Create your account</h1><p class="auth-description">Set up the owner account for this workspace. This page closes after the first account is created.</p>
<?php $errors = session()->getFlashdata('formErrors') ?? []; ?>
<?php if ($errors !== []): ?><div class="form-errors" role="alert"><?php foreach ($errors as $error): ?><p><?= esc($error) ?></p><?php endforeach; ?></div><?php endif; ?>
<form class="auth-form" action="<?= esc(site_url('setup')) ?>" method="post">
    <?= csrf_field() ?>
    <label for="full_name">Name</label><input id="full_name" name="full_name" type="text" maxlength="100" value="<?= esc(old('full_name') ?? '') ?>" autocomplete="name" required>
    <label for="username">Username</label><input id="username" name="username" type="text" minlength="3" maxlength="50" value="<?= esc(old('username') ?? '') ?>" autocomplete="username" required>
    <label for="email">Email</label><input id="email" name="email" type="email" maxlength="100" value="<?= esc(old('email') ?? '') ?>" autocomplete="email" required>
    <label for="password">Password <small>Use at least 8 characters.</small></label><input id="password" name="password" type="password" minlength="8" maxlength="72" autocomplete="new-password" required>
    <label for="password_confirm">Confirm password</label><input id="password_confirm" name="password_confirm" type="password" minlength="8" maxlength="72" autocomplete="new-password" required>
    <button class="button button-primary auth-submit" type="submit">Create owner account <span aria-hidden="true">→</span></button>
</form>
<p class="auth-footnote">Your password is secured before it is stored in the database.</p>
<?= $this->endSection() ?>
