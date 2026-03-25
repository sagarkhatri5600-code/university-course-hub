<div class="login-wrapper">
    <div class="login-box">
        <h2>Admin Login</h2>
        <form action="<?= url('/admin/login') ?>" method="POST">
            <input type="hidden" name="csrf_token" value="<?= \App\Core\Csrf::generate() ?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <p class="text-center mt-2"><a href="<?= url('/') ?>">&larr; Back to Site</a></p>
    </div>
</div>
