<section class="summary-grid" aria-label="Task summary">
    <?php foreach ($summaryItems as $item): ?>
        <article class="summary-card summary-<?= esc($item['tone']) ?>">
            <span class="summary-icon" aria-hidden="true"><?= esc($item['icon']) ?></span>
            <div><p><?= esc($item['label']) ?></p><strong><?= esc((string) $item['value']) ?></strong></div>
        </article>
    <?php endforeach; ?>
</section>
