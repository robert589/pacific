<?php
    use frontend\widgets\AddUserForm;
?>
<div id="<?= $id ?>" class="add-user view">
    <div class="view-header">
        Tambah User
    </div>
    <?= AddUserForm::widget(['id' => $id . '-form']) ?>
</div>