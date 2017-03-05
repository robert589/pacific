<?php
    use common\widgets\Button;
    use yii\grid\GridView;
?>
<div id="<?= $id ?>" class="list-code-type view">
    <div class="view-header">
        Daftar Tipe Kode
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Tipe Kode', 'newClass' => 'view-header-btn']) ?>
    </div>

    <?=  GridView::widget(
            ['dataProvider' => $provider,
             'columns' => [
                'id',
                'name',
                 'status',
                'description',
                                 [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Actions',    
                    'template' => '{edit}{remove}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        
                    },
                    'buttons' => [
                        //view button
                        'edit' => function ($url, $model) {
                            if($model['active']) { 
                                return Button::widget(['id' => 'lct-edit-' . $model['id'], 
                                    'widgetClass' => 'button-link list-code-type-edit',
                                    'text' => 'Edit',
                                    'options' => [
                                        'data-entity-type-id' => $model['id']
                                    ],
                                    'color' => Button::NONE_COLOR
                                ]);
                        
                            }      
                        }, 
                        'remove' => function($url, $model) {
                            if($model['active']) { 
                                return Button::widget(['id' => 'lc-remove-' . $model['id'], 
                                    'widgetClass' => 'button-link list-code-type-remove',
                                    'text' => 'Remove',
                                    'options' => [
                                        'data-entity-type-id' => $model['id']
                                    ],
                                    'color' => Button::NONE_COLOR
                                ]);
                            }
                        }
                    ],

                ]

            ]
        ]) ?>

</div>