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
            <tr class="<?= !$msg['is_read'] ? 'message-row-unread' : '' ?>">
                <td>
                    <div><?= escape($msg['name']) ?></div>
                    <small class="message-meta-email"><?= escape($msg['email']) ?></small>
                    <div class="message-meta-date"><?= date('d/m/Y H:i', strtotime($msg['created_at'])) ?></div>
                </td>
                <td><?= escape($msg['subject']) ?></td>
                <td>
                    <div class="message-preview">
                        <?= escape($msg['message']) ?>
                    </div>
                </td>
                <td>
                    <?php if (!$msg['is_read']): ?>
                        <a href="<?= siteUrl('admin/messages.php?read=' . $msg['id']) ?>" class="btn" title="Marquer lu"><i class="fas fa-check"></i></a>
                    <?php endif; ?>
                    <a href="mailto:<?= escape($msg['email']) ?>" class="btn"><i class="fas fa-reply"></i></a>
                    <a href="<?= siteUrl('admin/messages.php?delete=' . $msg['id']) ?>" class="btn btn-icon-danger" onclick="return confirm('Supprimer ?');"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
