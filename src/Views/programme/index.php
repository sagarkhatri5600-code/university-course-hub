<div class="page-header">
    <h1>Our Programmes</h1>
    <p>Find the right degree for your career goals.</p>
</div>

<div class="filter-section">
    <form action="<?= url('/programmes') ?>" method="GET" class="filter-form">
        <div class="form-group">
            <input type="text" name="search" placeholder="Search by keyword..." value="<?= htmlspecialchars($search) ?>">
        </div>
        <div class="form-group">
            <select name="level">
                <option value="">All Levels</option>
                <?php foreach($levels as $lvl): ?>
                    <option value="<?= htmlspecialchars($lvl['LevelName']) ?>" <?= $selectedLevel === $lvl['LevelName'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($lvl['LevelName']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="<?= url('/programmes') ?>" class="btn btn-secondary">Reset</a>
    </form>
</div>

<div class="programmes-grid">
    <?php if(empty($programmes)): ?>
        <p>No programmes found matching your criteria.</p>
    <?php else: ?>
        <?php foreach($programmes as $prog): ?>
            <div class="card">
                <?php if($prog['Image']): ?>
                    <img src="<?= htmlspecialchars($prog['Image']) ?>" alt="<?= htmlspecialchars($prog['ProgrammeName']) ?>" class="card-img">
                <?php else: ?>
                    <div class="card-img-placeholder">🎓</div>
                <?php endif; ?>
                <div class="card-body">
                    <span class="badge"><?= htmlspecialchars($prog['LevelName']) ?></span>
                    <h3><?= htmlspecialchars($prog['ProgrammeName']) ?></h3>
                    <p class="text-muted">Led by: <?= htmlspecialchars($prog['LeaderName'] ?? 'TBA') ?></p>
                    <p class="truncate"><?= htmlspecialchars($prog['Description']) ?></p>
                    <a href="<?= url('/programme/' . $prog['ProgrammeID']) ?>" class="btn btn-outline">View Details</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
