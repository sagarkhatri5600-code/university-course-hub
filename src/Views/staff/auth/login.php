<div class="login-wrapper">
    <div class="login-box">
        <h2>Staff Login</h2>
        <p class="text-muted">Use the email and password provided by your administrator.</p>
        <form action="<?= url('/staff/login') ?>" method="POST">
            <input type="hidden" name="csrf_token" value="<?= \App\Core\Csrf::generate() ?>">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required autofocus autocomplete="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required autocomplete="current-password">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
        </form>
        <p class="text-center mt-2"><a href="<?= url('/') ?>">&larr; Back to Site</a></p>
    </div>
</div>
