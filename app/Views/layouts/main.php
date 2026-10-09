<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0b261d">
    <meta name="description" content="EverTask helps you see today's priorities clearly and calmly.">
    <title><?= esc($title) ?> · EverTask</title>
    <link rel="stylesheet" href="<?= esc(base_url('assets/css/style.css')) ?>">
    <script src="<?= esc(base_url('assets/js/app.js')) ?>" defer></script>
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to content</a>
    <div class="ambient ambient-one" aria-hidden="true"></div>
    <div class="ambient ambient-two" aria-hidden="true"></div>
    <div class="app-shell">
        <?= $this->include('partials/sidebar') ?>
        <div class="workspace">
            <?= $this->include('partials/header') ?>
            <main id="main-content" class="main-content" tabindex="-1">
                <?php if ($message = session()->getFlashdata('success')): ?><div class="flash-message flash-success" role="status"><?= esc($message) ?></div><?php endif; ?>
                <?php if ($message = session()->getFlashdata('error')): ?><div class="flash-message flash-error" role="alert"><?= esc($message) ?></div><?php endif; ?>
                <?= $this->renderSection('content') ?>
            </main>
            <?= $this->include('partials/footer') ?>
        </div>
    </div>
    <?= $this->include('partials/mobile_nav') ?>
</body>
</html>
