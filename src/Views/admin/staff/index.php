<div class="admin-header">
    <h1>Manage Staff</h1>
    <a href="<?= url('/admin/staff/create') ?>" class="btn btn-primary">Add Staff</a>
</div>

<div class="table-responsive">
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email (login)</th>
                <th>Portal</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($staffList as $st): ?>
                <tr>
                    <td><?= (int) $st['StaffID'] ?></td>
                    <td><?= htmlspecialchars($st['Name']) ?></td>
                    <td><?= $st['Email'] ? htmlspecialchars($st['Email']) : '—' ?></td>
                    <td><?= !empty($st['PasswordHash']) && !empty($st['Email']) ? 'Yes' : 'No' ?></td>
                    <td class="actions">
                        <a href="<?= url('/admin/staff/edit/' . $st['StaffID']) ?>" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="<?= url('/admin/staff/delete/' . $st['StaffID']) ?>" method="POST" class="inline-form" onsubmit="return confirm('Delete this staff record?');">
                            <input type="hidden" name="csrf_token" value="<?= \App\Core\Csrf::generate() ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($staffList)): ?>
                <tr>
                    <td colspan="5" class="text-center">No staff found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
