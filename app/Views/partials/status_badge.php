<?php
$status = (string) ($status ?? 'pending');
$statusLabels = ['pending' => 'Pending', 'in_progress' => 'In progress', 'completed' => 'Completed'];
$statusClass = array_key_exists($status, $statusLabels) ? $status : 'pending';
$statusLabel = $statusLabels[$status] ?? 'Pending';
?>
<span class="status-badge status-<?= esc($statusClass) ?>"><span class="status-dot" aria-hidden="true"></span><?= esc($statusLabel) ?></span>
