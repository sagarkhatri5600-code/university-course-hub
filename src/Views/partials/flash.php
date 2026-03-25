<?php 
$flash = \App\Core\Session::getFlash();
if ($flash): 
?>
    <div class="alert alert-<?= htmlspecialchars($flash['type']) ?>">
        <?= htmlspecialchars($flash['message']) ?>
    </div>
<?php endif; ?>
