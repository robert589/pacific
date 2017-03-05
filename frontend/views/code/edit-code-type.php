<?php
    use frontend\widgets\EditCodeTypeForm;
?>
<div id="<?= $id ?>" class="edit-code-type view">
    <div class="view-header">
        Edit Tipe Kode
    </div>
    <?= EditCodeTypeForm::widget(['id' => $id . '-form', 'vo' => $vo]) ?>
</div>