<?php
    use common\widgets\Button;
    use common\widgets\SearchField;
?>


<div id="<?= $id ?>" class="ship-owner view">
    <div class="view-header">
        Tambah Pemilih ke kapal
    </div>
    
    <div class="ship-owner-header">
        <?= SearchField::widget(['id' => $id . '-ship', 
            'placeholder' => 'Cari Kapal',
            'name' => 'ship_id', 'url' => \Yii::$app->request->baseUrl . '/ship/search']) ?>
        
        <?= SearchField::widget(['id' => $id . '-owner', 
            'placeholder' => 'Cari Owner', 'disabled' => true,
            'name' => 'owner_id', 'url' => \Yii::$app->request->baseUrl . '/owner/search']) ?>
        
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Add', 'newClass' => 'ship-owner-btn',
                            'disabled' => true]) ?>
    </div>
    
    <div class="ship-owner-area">
        
    </div>
</div>