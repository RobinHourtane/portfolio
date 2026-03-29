<div class="login-box">
    <h2 style="color: var(--text-main); text-align: center; margin-bottom: 2rem;">_admin_access</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= escape($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div style="margin-bottom: 1rem;">
            <label style="color: var(--text-secondary);">User</label>
            <input type="text" name="username" class="form-control" required autofocus>
        </div>
        <div style="margin-bottom: 2rem;">
            <label style="color: var(--text-secondary);">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
