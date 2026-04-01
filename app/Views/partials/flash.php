<?php
use App\Core\Session;

$flash = Session::getFlash();
if ($flash): ?>
    <div class="flash"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>