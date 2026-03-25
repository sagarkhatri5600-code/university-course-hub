<div class="hero">
    <div class="hero-content">
        <h1>Welcome to the University Course Portal</h1>
        <p>Discover your future with our undergraduate and postgraduate programmes.</p>
        <div class="hero-actions">
            <a href="<?= url('/programmes') ?>" class="btn btn-primary">Browse Programmes</a>
        </div>
    </div>
</div>

<div class="section">
    <h2>Academic Excellence, Inspired by Tradition</h2>
    <p>Explore a wide variety of cutting-edge technology and science courses designed to prepare you for the real world. We offer comprehensive modules, expert staff, and a modern curriculum.</p>
</div>

<div class="section bg-light">
    <h2>Withdraw Interest</h2>
    <p>If you no longer wish to receive communications from us, you can withdraw your interest.</p>
    <form action="<?= url('/interest/withdraw') ?>" method="POST" class="withdraw-form">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Csrf::generate() ?>">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" required placeholder="Enter your registered email">
        </div>
        <button type="submit" class="btn btn-danger">Withdraw Interest</button>
    </form>
</div>
