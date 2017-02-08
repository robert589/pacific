<?php
    use frontend\widgets\CreateOwnerForm;
?>
<div id="<?= $id ?>" class="create-owner view">
    <div class="view-header">
        Tambah Pemilik Kapal
    </div>
    <?=  CreateOwnerForm::widget(['id' => $id . '-form']) ?>
</div>