<?php
    use frontend\widgets\EditWarehouseForm;
?>
<div id="<?= $id ?>" class="edit-warehouse view">
    <div class="view-header">
        Edit Warehouse
    </div>
    <?= EditWarehouseForm::widget(['id' => $id . '-form', 'vo' => $vo]) ?>
</div>