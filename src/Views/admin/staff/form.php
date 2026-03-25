<div class="admin-header">
    <h1><?= $member ? 'Edit Staff' : 'Add Staff' ?></h1>
    <a href="<?= url('/admin/staff') ?>" class="btn btn-secondary">Cancel</a>
</div>

<div class="form-container">
    <form action="<?= $member ? url('/admin/staff/update/' . $member['StaffID']) : url('/admin/staff/store') ?>" method="POST">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Csrf::generate() ?>">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required value="<?= htmlspecialchars($member['Name'] ?? '') ?>">
        </div>

        <?php if ($member): ?>
            <div class="form-group">
                <label for="email">Email (staff login)</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($member['Email'] ?? '') ?>">
                <small class="text-muted">Required for portal access unless you revoke below.</small>
            </div>

            <div class="form-group">
                <label for="password">New password (optional)</label>
                <input type="password" name="password" id="password" autocomplete="new-password" minlength="8">
                <small class="text-muted">Leave blank to keep the current password. Minimum 8 characters if set.</small>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="revoke_portal" value="1">
                    Revoke portal access (remove email and password from this record)
                </label>
            </div>
        <?php else: ?>
            <div class="form-group">
                <label for="email">Email (staff login)</label>
                <input type="email" name="email" id="email" required autocomplete="username">
            </div>

            <div class="form-group">
                <label for="password">Initial password</label>
                <input type="password" name="password" id="password" required autocomplete="new-password" minlength="8">
                <small class="text-muted">Share this with the staff member securely; the application does not send email.</small>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary"><?= $member ? 'Update' : 'Create' ?></button>
    </form>
</div>
