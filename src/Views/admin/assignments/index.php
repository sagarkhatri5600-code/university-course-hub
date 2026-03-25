<div class="admin-header">
    <h1>Assign Modules to Programmes</h1>
</div>

<div class="assignment-layout">
    <div class="programme-selector">
        <form action="<?= url('/admin/assignments') ?>" method="GET" class="filter-form">
            <div class="form-group">
                <label for="programme_id">Select Programme</label>
                <select name="programme_id" id="programme_id" onchange="this.form.submit()">
                    <option value="">-- Choose Programme --</option>
                    <?php foreach($programmes as $prog): ?>
                        <option value="<?= $prog['ProgrammeID'] ?>" <?= $selectedProgrammeId == $prog['ProgrammeID'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($prog['ProgrammeName']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
    </div>

    <?php if($selectedProgrammeId): ?>
        <div class="assignment-panels">
            <div class="panel">
                <h3>Add Module to Programme</h3>
                <form action="<?= url('/admin/assignments/store') ?>" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Csrf::generate() ?>">
                    <input type="hidden" name="programme_id" value="<?= $selectedProgrammeId ?>">
                    
                    <div class="form-group">
                        <label for="module_id">Module</label>
                        <select name="module_id" id="module_id" required>
                            <option value="">Select Module</option>
                            <?php foreach($allModules as $am): ?>
                                <option value="<?= $am['ModuleID'] ?>"><?= htmlspecialchars($am['ModuleName']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="year">Year</label>
                        <select name="year" id="year" required>
                            <option value="1">Year 1</option>
                            <option value="2">Year 2</option>
                            <option value="3">Year 3</option>
                            <option value="4">Year 4</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Assign Module</button>
                </form>
            </div>

            <div class="panel">
                <h3>Currently Assigned Modules</h3>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Module</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($assignedModules as $am): ?>
                            <tr>
                                <td>Year <?= $am['Year'] ?></td>
                                <td><?= htmlspecialchars($am['ModuleName']) ?></td>
                                <td>
                                    <form action="<?= url('/admin/assignments/delete/' . $am['ProgrammeModuleID']) ?>" method="POST" onsubmit="return confirm('Remove this module assignment?');">
                                        <input type="hidden" name="csrf_token" value="<?= \App\Core\Csrf::generate() ?>">
                                        <input type="hidden" name="programme_id" value="<?= $selectedProgrammeId ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(empty($assignedModules)): ?>
                            <tr>
                                <td colspan="3">No modules assigned yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <p>Please select a programme to view and manage its modules.</p>
    <?php endif; ?>
</div>
