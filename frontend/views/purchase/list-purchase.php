<?php
    use frontend\vos\RoleVo;
    use common\widgets\Button;
    use frontend\widgets\AddPurchaseForm;
    use yii\grid\GridView;
?>
<div id="<?= $id ?>" class="list-purchase view">
    <div class="view-header">
        Daftar Pembelian
    </div>
    
    <?= Button::widget(['id' => $id . '-showform', 
                        'text' => 'Tambah Pembelian 
                            <span class="glyphicon glyphicon-arrow-down"></span>', 
                        'newClass' => 'list-purchase-showform']) ?>
    
    <div class="list-purchase-formarea">
        <?= AddPurchaseForm::widget(['id' => $id . '-form']) ?>
    </div>
    
    <?=  GridView::widget(
        [   'dataProvider' => $provider,
            'columns' => [
                'product_name',
                'date',
                'quantity',
                'expired_date',
                'warehouse_name',
                'status',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Actions',    
                    'template' => '{remove}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        
                    },
                    'buttons' => [
                        //view button
                        'remove' => function ($url, $model) {
                            if($model['active']) {
                                return Button::widget(
                                        ['id' => 'lp-' . $model['id'], 
                                        'newClass' => 'list-purchase-remove button-link',
                                        'text' => 'Remove',
                                        'color' => Button::NONE_COLOR,
                                        'options' => [
                                            'data-purchase-id' => $model['id']
                                        ]
                                ]);
                            }
                        }
                    ],

                ]

            ]
        ]); ?>
    
</div>