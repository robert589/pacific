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
                'current_status',
                'type',
                'description',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Actions',    
                    'template' => '{add} - {edit} - {remove}',
                    'buttons' => [
                        //view button
                        'add' => function ($url, $model) {
                            if($model['active']) {
                                return Button::widget(['id' => 'lc-add-' . $model['code'],
                                    'widgetClass' => 'button-link list-code-add',
                                    'text' => 'Tambah Sub Kode',
                                    'options' => [
                                        'data-entity-id' => $model['id']
                                    ],
                                    'color' => Button::NONE_COLOR]);
                            }
                        },
                        'edit' => function ($url, $model) {
                            if($model['active']) { 
                                return Button::widget(['id' => 'lc-edit-' . $model['code'], 
                                    'widgetClass' => 'button-link list-code-edit',
                                    'text' => 'Edit',
                                    'options' => [
                                        'data-entity-id' => $model['id']
                                    ],
                                    'color' => Button::NONE_COLOR
                                ]);
                        
                            }      
                        }, 
                        'remove' => function($url, $model) {
                            if($model['active']) { 
                                return Button::widget(['id' => 'lc-remove-' . $model['code'], 
                                    'widgetClass' => 'button-link list-code-remove',
                                    'text' => 'Remove',
                                    'options' => [
                                        'data-entity-id' => $model['id']
                                    ],
                                    'color' => Button::NONE_COLOR
                                ]);
                            }
                        }
                    ],

                ]
            ]
        ]); ?>
    
</div>