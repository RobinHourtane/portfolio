<h1>Tableau de bord</h1>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 2rem;">
    <div style="background: var(--bg-darker); padding: 1.5rem; border: 1px solid var(--border); border-radius: 8px;">
        <h3 style="color: var(--text-secondary);">Projets en ligne</h3>
        <p style="font-size: 2rem; color: var(--accent-turquoise);"><?= (int) $stats['projects'] ?></p>
    </div>
    <div style="background: var(--bg-darker); padding: 1.5rem; border: 1px solid var(--border); border-radius: 8px;">
        <h3 style="color: var(--text-secondary);">Messages non lus</h3>
        <p style="font-size: 2rem; color: <?= $stats['messages'] > 0 ? 'var(--accent-rose)' : 'var(--text-main)' ?>;"><?= (int) $stats['messages'] ?></p>
    </div>
</div>

<h2 style="margin-top: 3rem;">Derniers messages</h2>
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
