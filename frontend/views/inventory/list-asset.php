<?php
    use common\widgets\Button;
    use frontend\widgets\AddAssetFormModal;
    use yii\grid\GridView;
?>
<div id="<?= $id ?>" class="list-asset view">
    <div class="view-header">
        Daftar Aset
        <?= Button::widget(['id' => $id . '-triggerasf-modal', 
                            'text' => 'Tambah Aset', 
                            'newClass' => 'view-header-btn']) ?>
    </div>
    
    <?=    AddAssetFormModal::widget(['id' => $id . '-modal']) ?>
    
    <?=  GridView::widget(
        [   'dataProvider' => $provider,
            'columns' => [
                'name',
                'method'
            ]
        ]); ?>
    
</div>