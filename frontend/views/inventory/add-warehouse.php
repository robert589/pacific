<?php
    use frontend\widgets\AddWarehouseForm;
?>
<div id="<?= $id ?>" class="add-wh view">
    <div class="view-header">
        Tambah Kode
    </div>
    <?= AddWarehouseForm::widget(['id' => $id . '-form']) ?>
</div>