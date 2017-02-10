<?php
    use frontend\widgets\CreateCodeTypeForm;
?>
<div id="<?= $id ?>" class="create-codetype view">
    <div class="view-header">
        Tambah Tipe Kode
    </div>
    <?= CreateCodeTypeForm::widget(['id' => $id . '-form']) ?>
</div>