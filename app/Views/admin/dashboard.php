<h1>Tableau de bord</h1>

<div class="admin-stats-grid">
    <div class="admin-stat-card">
        <h3 class="admin-stat-title">Projets en ligne</h3>
        <p class="admin-stat-value admin-stat-value--accent"><?= (int) $stats['projects'] ?></p>
    </div>
    <div class="admin-stat-card">
        <h3 class="admin-stat-title">Messages non lus</h3>
        <p class="admin-stat-value <?= $stats['messages'] > 0 ? 'admin-stat-value--alert' : 'admin-stat-value--neutral' ?>"><?= (int) $stats['messages'] ?></p>
    </div>
</div>

<h2 class="admin-section-title">Derniers messages</h2>
<table class="data-table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Nom</th>
            <th>Sujet</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($latestMessages as $msg): ?>
            <tr>
                <td><?= date('d/m/Y', strtotime($msg['created_at'])) ?></td>
                <td><?= escape($msg['name']) ?></td>
                <td><?= escape($msg['subject']) ?></td>
                <td>
                    <?php if ($msg['is_read']): ?>
                        <span class="badge badge-success">Lu</span>
                    <?php else: ?>
                        <span class="badge badge-warning">Nouveau</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
