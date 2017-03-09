<?php
    use common\widgets\Button;
    use yii\grid\GridView;
    use frontend\widgets\AddOwnerToCodeFormBtnc;
?>
<div id="<?= $id ?>" class="view-code view" data-id="<?= $entityVo->getId() ?>">
    <div class="view-header">
        Nama Kode: <?= $entityVo->getName() ?> <br>
        Kode: <?= $entityVo->getCode() ?>
        <?= Button::widget(['id' => $id . '-subcode', 'text' => 'Tambah Sub Kode', 'newClass' => 'view-header-btn']) ?>
        <?= Button::widget(['id' => $id . '-edit', 'text' => 'Edit', 'newClass' => 'view-header-btn']) ?>
    </div>
    
    <div class="view-label">
        Person in Charge:
    </div>
    <?=    AddOwnerToCodeFormBtnc::widget(['id' => $id . '-aotcfb', 'entityId' => $entityVo->getId()]) ?>
    
    <?=  GridView::widget(
        [   'dataProvider' => $ownerProvider,
            'columns' => [
                'id',
                'name']
            ]); ?>
</div>