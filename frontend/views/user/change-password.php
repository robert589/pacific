<?php
    use frontend\widgets\ChangePasswordForm;
?>
<div id="<?= $id ?>" class="change-pass view">
    <div class="view-header">
        Ganti Password
    </div>
    <?= ChangePasswordForm::widget(['id' => $id . '-form']) ?>
</div>