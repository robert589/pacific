<?php
    use frontend\widgets\AddRoleForm;
?>
<div id="<?= $id ?>" class="add-role view">
    <div class="view-header">
        Tambah Peran
    </div>
    <?= AddRoleForm::widget(['id' => $id . '-form']) ?>
</div>