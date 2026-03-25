<div class="admin-header">
    <h1><?= $programme ? 'Edit Programme' : 'Add New Programme' ?></h1>
    <a href="<?= url('/admin/programmes') ?>" class="btn btn-secondary">Cancel</a>
</div>

<div class="form-container">
    <form action="<?= $programme ? url('/admin/programmes/update/' . $programme['ProgrammeID']) : url('/admin/programmes/store') ?>" method="POST">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Csrf::generate() ?>">
        
        <div class="form-group">
            <label for="name">Programme Name</label>
            <input type="text" name="name" id="name" required value="<?= htmlspecialchars($programme['ProgrammeName'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="level_id">Level</label>
            <select name="level_id" id="level_id" required>
                <option value="">Select Level</option>
                <?php foreach($levels as $lvl): ?>
                    <option value="<?= $lvl['LevelID'] ?>" <?= ($programme['LevelID'] ?? '') == $lvl['LevelID'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($lvl['LevelName']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="leader_id">Programme Leader</label>
            <select name="leader_id" id="leader_id">
                <option value="">Select Leader</option>
                <?php foreach($staff as $st): ?>
                    <option value="<?= $st['StaffID'] ?>" <?= ($programme['ProgrammeLeaderID'] ?? '') == $st['StaffID'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($st['Name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5" required><?= htmlspecialchars($programme['Description'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label for="image">Image URL (Optional)</label>
            <input type="url" name="image" id="image" value="<?= htmlspecialchars($programme['Image'] ?? '') ?>">
        </div>

        <button type="submit" class="btn btn-primary">Save Programme</button>
    </form>
</div>
