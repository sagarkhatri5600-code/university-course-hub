<div class="admin-header">
    <h1>Manage Programmes</h1>
    <a href="<?= url('/admin/programmes/create') ?>" class="btn btn-primary">Add New Programme</a>
</div>

<div class="table-responsive">
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Level</th>
                <th>Leader</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($programmes as $prog): ?>
                <tr>
                    <td><?= $prog['ProgrammeID'] ?></td>
                    <td><?= htmlspecialchars($prog['ProgrammeName']) ?></td>
                    <td><?= htmlspecialchars($prog['LevelName']) ?></td>
                    <td><?= htmlspecialchars($prog['LeaderName'] ?? 'None') ?></td>
                    <td class="actions">
                        <a href="<?= url('/admin/programmes/edit/' . $prog['ProgrammeID']) ?>" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="<?= url('/admin/programmes/delete/' . $prog['ProgrammeID']) ?>" method="POST" class="inline-form" onsubmit="return confirm('Delete this programme?');">
                            <input type="hidden" name="csrf_token" value="<?= \App\Core\Csrf::generate() ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if(empty($programmes)): ?>
                <tr>
                    <td colspan="5" class="text-center">No programmes found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
