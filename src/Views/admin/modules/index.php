<div class="admin-header">
    <h1>Manage Modules</h1>
    <a href="<?= url('/admin/modules/create') ?>" class="btn btn-primary">Add New Module</a>
</div>

<div class="table-responsive">
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Leader</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($modules as $mod): ?>
                <tr>
                    <td><?= $mod['ModuleID'] ?></td>
                    <td><?= htmlspecialchars($mod['ModuleName']) ?></td>
                    <td><?= htmlspecialchars($mod['LeaderName'] ?? 'None') ?></td>
                    <td class="actions">
                        <a href="<?= url('/admin/modules/edit/' . $mod['ModuleID']) ?>" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="<?= url('/admin/modules/delete/' . $mod['ModuleID']) ?>" method="POST" class="inline-form" onsubmit="return confirm('Delete this module?');">
                            <input type="hidden" name="csrf_token" value="<?= \App\Core\Csrf::generate() ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if(empty($modules)): ?>
                <tr>
                    <td colspan="4" class="text-center">No modules found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
