<?php
    use frontend\widgets\CreateCodeForm;
?>
<div id="<?= $id ?>" class="create-code view">
    <div class="view-header">
        Tambah Kode
    </div>
    <?= CreateCodeForm::widget(['id' => $id . '-form']) ?>
</div>