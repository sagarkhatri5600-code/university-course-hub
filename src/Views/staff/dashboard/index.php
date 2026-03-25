<div class="admin-header">
    <h1>My teaching</h1>
    <p class="text-muted">Signed in as <?= htmlspecialchars(\App\Core\Session::get('staff_name') ?? '') ?></p>
</div>

<div class="section text-left" style="text-align: left; max-width: 900px; margin: 0 auto 2rem;">
    <h2>Modules I lead</h2>
    <?php if (empty($modulesLed)): ?>
        <p>You are not listed as the leader of any module yet. When an administrator assigns you as a module leader, those modules will appear here.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($modulesLed as $mod): ?>
                        <tr>
                            <td><?= htmlspecialchars($mod['ModuleName']) ?></td>
                            <td><?= htmlspecialchars($mod['Description'] ?? '') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<div class="section text-left" style="text-align: left; max-width: 900px; margin: 0 auto;">
    <h2>Programmes that include my modules</h2>
    <?php if (empty($impactByProgramme)): ?>
        <p>No programme assignments yet for modules you lead.</p>
    <?php else: ?>
        <?php foreach ($impactByProgramme as $prog): ?>
            <div class="year-block" style="margin-bottom: 1.5rem;">
                <h3><?= htmlspecialchars($prog['ProgrammeName']) ?></h3>
                <p class="text-muted"><?= htmlspecialchars($prog['LevelName'] ?? '—') ?></p>
                <ul class="module-list">
                    <?php foreach ($prog['rows'] as $row): ?>
                        <li>
                            <strong><?= htmlspecialchars($row['ModuleName']) ?></strong>
                            <span class="module-leader">Year <?= htmlspecialchars((string) $row['Year']) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
