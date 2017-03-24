<?php
    use common\widgets\Button;
    use yii\grid\GridView;
?>
<div id="<?= $id ?>" class="list-warehouse view">
    <div class="view-header">
        Daftar Warehouse
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Warehouse', 'newClass' => 'view-header-btn']) ?>
    </div>

    <?=  GridView::widget(
        [   'dataProvider' => $provider,
            'columns' => [
                'id',
                'name',
                'location',
                'selling_place',
                'status',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Actions',    
                    'template' => '{view} - {edit} - {remove}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        
                    },
                    'buttons' => [
                        //view button
                        'view' => function ($url, $model) {
                            if($model['active']) {
                                return Button::widget(
                                        ['id' => 'ilw-' . $model['id'],
                                            'text' => 'View',
                                            'color' => Button::NONE_COLOR, 
                                            'newClass' => 'list-warehouse-view button-link',
                                        'options' => 
                                            [
                                                'data-entity-id' => $model['id']
                                            ]
                                        ]);
                            }
                        },
                        'remove' => function ($url, $model) {
                            if($model['active']) {
                                return Button::widget(
                                        ['id' => 'ilw-' . $model['id'],
                                            'text' => 'Remove',
                                            'color' => Button::NONE_COLOR, 
                                            'newClass' => 'list-warehouse-remove button-link',
                                        'options' => 
                                            [
                                                'data-entity-id' => $model['id']
                                            ]
                                        ]);
                            }
                        },
                        'edit' => function ($url, $model) {
                            if($model['active']) {
                                return Button::widget(
                                        ['id' => 'ilw-' . $model['id'],
                                            'text' => 'Edit',
                                            'color' => Button::NONE_COLOR, 
                                            'newClass' => 'list-warehouse-edit button-link',
                                            'options' => 
                                            [
                                                'data-entity-id' => $model['id']
                                            ]
                                        ]);
                            }
                        }
                    ],

                ]

            ]
        ]); ?>
    
</div>