<div class="login-box">
    <h2 class="auth-title">_admin_access</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= escape($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="auth-field">
            <label class="auth-label">User</label>
            <input type="text" name="username" class="form-control" required autofocus>
        </div>
        <div class="auth-field auth-field-spaced">
            <label class="auth-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
