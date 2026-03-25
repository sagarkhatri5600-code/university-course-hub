<div class="programme-header">
    <a href="<?= url('/programmes') ?>" class="btn btn-link">&larr; Back to Programmes</a>
    <h1><?= htmlspecialchars($programme['ProgrammeName']) ?></h1>
    <span class="badge badge-large"><?= htmlspecialchars($programme['LevelName']) ?></span>
    <p class="leader-info">Programme Leader: <strong><?= htmlspecialchars($programme['LeaderName'] ?? 'TBA') ?></strong></p>
</div>

<div class="programme-layout">
    <div class="programme-main">
        <div class="section">
            <h2>About this Programme</h2>
            <p><?= nl2br(htmlspecialchars($programme['Description'])) ?></p>
        </div>

        <div class="section">
            <h2>Course Structure (Modules)</h2>
            <?php if(empty($modulesByYear)): ?>
                <p>No modules assigned yet.</p>
            <?php else: ?>
                <?php foreach($modulesByYear as $year => $modules): ?>
                    <div class="year-block">
                        <h3>Year <?= htmlspecialchars($year) ?></h3>
                        <ul class="module-list">
                            <?php foreach($modules as $mod): ?>
                                <li>
                                    <strong><?= htmlspecialchars($mod['ModuleName']) ?></strong>
                                    <span class="module-leader">Led by: <?= htmlspecialchars($mod['LeaderName'] ?? 'TBA') ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="programme-sidebar">
        <div class="register-interest-card">
            <h3>Register Your Interest</h3>
            <p>Want to know more about this programme? Sign up for updates.</p>
            
            <form action="<?= url('/interest/register') ?>" method="POST">
                <input type="hidden" name="csrf_token" value="<?= \App\Core\Csrf::generate() ?>">
                <input type="hidden" name="programme_id" value="<?= $programme['ProgrammeID'] ?>">
                
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" required placeholder="John Doe">
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" required placeholder="john@example.com">
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Keep Me Posted</button>
            </form>
        </div>
    </div>
</div>
