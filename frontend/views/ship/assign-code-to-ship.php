<?php
    use frontend\widgets\AssignCodeToShipForm;
?>
<div id="<?= $id ?>" class="act-ship view">
    <div class="view-header">
        Tambah Kode untuk Kapal
    </div>
    <?= AssignCodeToShipForm::widget(['id' => $id . '-form']) ?>
</div>