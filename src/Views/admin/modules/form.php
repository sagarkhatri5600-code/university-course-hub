<div class="admin-header">
    <h1><?= $module ? 'Edit Module' : 'Add New Module' ?></h1>
    <a href="<?= url('/admin/modules') ?>" class="btn btn-secondary">Cancel</a>
</div>

<div class="form-container">
    <form action="<?= $module ? url('/admin/modules/update/' . $module['ModuleID']) : url('/admin/modules/store') ?>" method="POST">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Csrf::generate() ?>">
        
        <div class="form-group">
            <label for="name">Module Name</label>
            <input type="text" name="name" id="name" required value="<?= htmlspecialchars($module['ModuleName'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="leader_id">Module Leader</label>
            <select name="leader_id" id="leader_id">
                <option value="">Select Leader</option>
                <?php foreach($staff as $st): ?>
                    <option value="<?= $st['StaffID'] ?>" <?= ($module['ModuleLeaderID'] ?? '') == $st['StaffID'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($st['Name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5" required><?= htmlspecialchars($module['Description'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label for="image">Image URL (Optional)</label>
            <input type="url" name="image" id="image" value="<?= htmlspecialchars($module['Image'] ?? '') ?>">
        </div>

        <button type="submit" class="btn btn-primary">Save Module</button>
    </form>
</div>
