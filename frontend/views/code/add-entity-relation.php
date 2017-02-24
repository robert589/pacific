<?php
    use yii\grid\GridView;
    use frontend\widgets\AddEntityRelationForm;
    use common\widgets\Button;
    use frontend\widgets\AddEntityRelationRangeForm;
?>

<div id="<?= $id ?>" class="aer view" data-code-id="<?= $vo->getId() ?>">
    <div class="view-header">
        Tambah Sub Kode untuk Kode: <?= $vo->getCode() ?> <?= $vo->getName() ?> 
    </div>
    
    <div class="aer-form">
        <?= AddEntityRelationForm::widget(['id' => $id . '-form', 'code' => $vo->getId()]) ?>
        
        <?= AddEntityRelationRangeForm::widget(['id' => $id . '-rform', 
                                'code' => $vo->getId()]) ?>
    </div>
    
    
    <?=  GridView::widget(
        [   'dataProvider' => $provider,
            'columns' => [
                'code',
                'name',
                'type',
                'description',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Actions',    
                    'template' => '{remove}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        
                    },
                    'buttons' => [
                        //view button
                        'remove' => function ($url, $model) {
                            return Button::widget(['id' => 'aer-remove-' . $model['code'],
                                'widgetClass' => 'button-link aer-remove',
                                'text' => 'Remove',
                                'options' => [
                                    'data-entity-id' => $model['id']
                                ],
                                'color' => Button::NONE_COLOR]);
                        }
                    ],

                ]
            ]
        ]); ?>
    
    <?= Button::widget(['id' => $id . '-remove-all', 'text' => 'Hapus Semua Relasi',
        'newClass' => 'button-link aer-remove-all', 'color' => Button::NONE_COLOR]) ?>
</div>