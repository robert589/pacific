<?php
    use frontend\widgets\EditCodeForm;
?>
<div id="<?= $id ?>" class="edit-code view">
    <div class="view-header">
        Edit Kode
    </div>
    <?= EditCodeForm::widget(['id' => $id . '-form', 'vo' => $vo]) ?>
</div>