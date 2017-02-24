<?php
    use frontend\widgets\AddEntityRelationForm;
    use frontend\widgets\AddEntityRelationRangeForm;
?>

<div id="<?= $id ?>" class="aer view">
    <div class="view-header">
        Tambah Sub Kode untuk Kode: <?= $vo->getId() ?> <?= $vo->getName() ?> 
    </div>
    
    <div class="aer-form">
        <?= AddEntityRelationForm::widget(['id' => $id . '-form', 'code' => $vo->getId()]) ?>
        
        <?= AddEntityRelationRangeForm::widget(['id' => $id . '-rform', 
                                'code' => $vo->getId()]) ?>
    </div>
    
    
</div>