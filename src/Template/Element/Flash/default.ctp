<?php
$class = 'alert';
if (!empty($params['class'])) {
    $class .= ' ' . ($params['class'] === 'error' ? 'alert-warning' : 'alert-success');
}
?>
<div class="<?= h($class) ?>"><?= h($message) ?></div>
