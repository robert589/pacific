<?php
    use frontend\vos\RoleVo;
    use common\widgets\Button;
    use frontend\widgets\AddPurchaseForm;
    use yii\grid\GridView;
?>
<div id="<?= $id ?>" class="list-inventory view">
    <div class="view-header">
        Daftar Aset
    </div>
    
    <?=  GridView::widget(
        [   'dataProvider' => $provider,
            'columns' => [
                'product_name',
                'warehouse_name',
                'quantity'

            ]
        ]); ?>
    
</div>