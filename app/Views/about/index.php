<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="about-hero">
    <div class="about-copy"><p class="hero-kicker"><span class="pulse-dot" aria-hidden="true"></span> SMALL STEPS, CLEAR INTENTIONS</p><h2>Make today<br><em>feel manageable.</em></h2><p>EverTask is a simple task overview built for a calmer start and a clearer finish. It brings the day’s priorities into view without adding noise.</p></div>
    <div class="about-mark" aria-hidden="true"><span class="mark-ring"></span><span class="mark-leaf">✦</span><small>Plan clearly.<br>Focus calmly.</small></div>
</section>

<section class="feature-grid" aria-label="Application features">
    <article class="feature-card"><span class="feature-number">01</span><span class="feature-icon" aria-hidden="true">◷</span><h3>Today at a glance</h3><p>The welcome page retrieves only tasks scheduled for the current day.</p></article>
    <article class="feature-card"><span class="feature-number">02</span><span class="feature-icon" aria-hidden="true">▤</span><h3>One clear schedule</h3><p>The task list displays all records in date order with readable status labels.</p></article>
    <article class="feature-card"><span class="feature-number">03</span><span class="feature-icon" aria-hidden="true">◎</span><h3>Database-backed</h3><p>CodeIgniter models retrieve task and demo-user information from MySQL.</p></article>
    <article class="feature-card"><span class="feature-number">04</span><span class="feature-icon" aria-hidden="true">◇</span><h3>Made for every screen</h3><p>Responsive layouts adapt the navigation and task records to smaller devices.</p></article>
</section>

<section class="about-lower">
    <article class="about-panel"><p class="eyebrow eyebrow-dark">BUILT WITH</p><h2>Simple tools, solid structure.</h2><div class="tech-list"><span>CodeIgniter 4</span><span>PHP</span><span>MySQL</span><span>HTML5</span><span>CSS3</span><span>Vanilla JavaScript</span></div><p>The application uses explicit routes, controllers, models, and views. Database records are loaded in models and safely escaped when displayed.</p></article>
    <article class="developer-panel"><p class="eyebrow">THE DEVELOPER</p><span class="developer-initials" aria-hidden="true">TC</span><h2><?= esc($developer) ?></h2><p><?= esc($course) ?></p><dl><div><dt>Section</dt><dd><?= esc($section) ?></dd></div><div><dt>Instructor</dt><dd><?= esc($professor) ?></dd></div></dl></article>
</section>
<?= $this->endSection() ?>
