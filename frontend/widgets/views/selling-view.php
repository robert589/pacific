<?php
    use frontend\widgets\SellingItem;
    use yii\grid\GridView;
?>

<div id="<?= $id ?>" class="selling-view">
    <div class="selling-view-footer">
        <div class="selling-view-footer-item3">
            Saldo Harian
        </div>
        <div class="selling-view-footer-item2">
        </div>
    </div>
    
    <?=    GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            'date',
            'product', 
            'buyer', 
            'price', 
            'unit', 
            'total'
        ]
    ]) ?>
</div>