<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="theme-color" content="#0b261d">
    <title><?= esc($title) ?> · EverTask</title>
    <link rel="stylesheet" href="<?= esc(base_url('assets/css/style.css')) ?>">
</head>
<body class="auth-page">
    <div class="ambient ambient-one" aria-hidden="true"></div><div class="ambient ambient-two" aria-hidden="true"></div>
    <main class="auth-shell">
        <a class="brand auth-brand" href="<?= esc(site_url('/')) ?>"><span class="brand-mark" aria-hidden="true">✦</span><span class="brand-copy"><strong>EverTask</strong><small>Tasks for Today</small></span></a>
        <section class="auth-card"><div class="auth-art" aria-hidden="true"><span class="auth-art-orbit"></span><span class="auth-art-leaf">✦</span></div><div class="auth-content"><?= $this->renderSection('content') ?></div></section>
        <p class="auth-copyright">A calmer kind of productivity · EverTask</p>
    </main>
</body>
</html>
