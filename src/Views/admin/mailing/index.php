<div class="admin-header">
    <h1>Mailing List</h1>
    <?php if($selectedProgrammeId): ?>
        <a href="<?= url('/admin/mailing/export?programme_id=' . $selectedProgrammeId) ?>" class="btn btn-secondary">Export to CSV</a>
    <?php else: ?>
        <a href="<?= url('/admin/mailing/export') ?>" class="btn btn-secondary">Export All to CSV</a>
    <?php endif; ?>
</div>

<div class="filter-section">
    <form action="<?= url('/admin/mailing') ?>" method="GET" class="filter-form">
        <div class="form-group">
            <label for="programme_id">Filter by Programme:</label>
            <select name="programme_id" id="programme_id" onchange="this.form.submit()">
                <option value="">All Programmes</option>
                <?php foreach($programmes as $prog): ?>
                    <option value="<?= $prog['ProgrammeID'] ?>" <?= $selectedProgrammeId == $prog['ProgrammeID'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($prog['ProgrammeName']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
</div>

<div class="table-responsive">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Interested In</th>
                <th>Date Registered</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($interests as $interest): ?>
                <tr>
                    <td><?= htmlspecialchars($interest['StudentName']) ?></td>
                    <td><?= htmlspecialchars($interest['Email']) ?></td>
                    <td><?= htmlspecialchars($interest['ProgrammeName']) ?></td>
                    <td><?= date('Y-m-d H:i', strtotime($interest['RegisteredAt'])) ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if(empty($interests)): ?>
                <tr>
                    <td colspan="4" class="text-center">No interested students found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
