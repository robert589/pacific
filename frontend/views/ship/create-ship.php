<?php
    use frontend\widgets\CreateShipForm;
?>
<div id="<?= $id ?>" class="create-ship view">
    <div class="view-header">
        Tambah Kapal
    </div>
    <?= CreateShipForm::widget(['id' => $id . '-form']) ?>
</div>