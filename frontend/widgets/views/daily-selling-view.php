<?php
    use frontend\widgets\AddSellingForm;
    use yii\grid\GridView;
    use frontend\widgets\DailySellingItem;
?>

<div id="<?= $id ?>" class="ds-view">
    <div class="ds-view-footer">
        <div class="ds-view-footer-item3">
            Saldo Harian
        </div>
        <div class="ds-view-footer-item2">
            <?= $totalSaldo ?>
        </div>
    </div>
    
    <?=    GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            'product', 'buyer', 'price', 'unit', 'total'
        ]
    ]) ?>
    
    
</div>