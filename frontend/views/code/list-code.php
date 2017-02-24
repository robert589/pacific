<?php
    use common\widgets\Button;
    use yii\grid\GridView;
?>
<div id="<?= $id ?>" class="list-code view">
    <div class="view-header">
        Daftar Kode
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Kode', 'newClass' => 'view-header-btn']) ?>
        <?= Button::widget(['id' => $id . '-codetype', 'text' => 'Tipe Kode', 'newClass' => 'view-header-btn']) ?>
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
                    'template' => '{add}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        
                    },
                    'buttons' => [
                        //view button
                        'add' => function ($url, $model) {
                            return Button::widget(['id' => 'ls-add-' . $model['code'],
                                'widgetClass' => 'button-link list-code-add',
                                'text' => '<span class="glyphicon glyphicon-plus"></span>',
                                'options' => [
                                    'data-entity-id' => $model['code']
                                ],
                                'color' => Button::NONE_COLOR]);
                        }
                    ],

                ]
            ]
        ]); ?>
    
</div>