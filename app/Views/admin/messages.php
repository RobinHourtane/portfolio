<h1>Messagerie</h1>

<table class="data-table">
    <thead>
        <tr>
            <th>De</th>
            <th>Sujet</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($messages as $msg): ?>
            <tr style="<?= !$msg['is_read'] ? 'background: rgba(255,255,255,0.05);' : '' ?>">
                <td>
                    <div><?= escape($msg['name']) ?></div>
                    <small style="color: var(--text-secondary);"><?= escape($msg['email']) ?></small>
                    <div style="font-size: 0.7rem; color: gray;"><?= date('d/m/Y H:i', strtotime($msg['created_at'])) ?></div>
                </td>
                <td><?= escape($msg['subject']) ?></td>
                <td>
                    <div style="max-width: 400px; max-height: 100px; overflow-y: auto; white-space: pre-wrap; font-size: 0.9rem; color: var(--text-secondary);">
                        <?= escape($msg['message']) ?>
                    </div>
                </td>
                <td>
                    <?php if (!$msg['is_read']): ?>
                        <a href="<?= siteUrl('admin/messages.php?read=' . $msg['id']) ?>" class="btn" title="Marquer lu"><i class="fas fa-check"></i></a>
                    <?php endif; ?>
                    <a href="mailto:<?= escape($msg['email']) ?>" class="btn"><i class="fas fa-reply"></i></a>
                    <a href="<?= siteUrl('admin/messages.php?delete=' . $msg['id']) ?>" class="btn" style="color: var(--accent-rose);" onclick="return confirm('Supprimer ?');"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
