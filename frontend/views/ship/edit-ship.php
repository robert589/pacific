<?php
    use frontend\widgets\EditShipForm;
?>
<div id="<?= $id ?>" class="edit-ship view">
    <div class="view-header">
        Edit Kapal
    </div>
    <?= EditShipForm::widget(['id' => $id . '-form', 'vo' => $vo]) ?>
</div>