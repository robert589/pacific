<?php
    use common\widgets\Button;
    use yii\grid\GridView;
?>
<div id="<?= $id ?>" class="list-ship view">
    <div class="view-header">
        Daftar Kapal
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Kapal', 'newClass' => 'view-header-btn']) ?>
    </div>

    <?=  GridView::widget(
            ['dataProvider' => $provider,
             'columns' => [
                 [
                    'header' => 'Id/Kode',
                     'attribute' => 'code'
                 ],
                'name',
                'description',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Actions',    
                    'template' => '{delete}{edit}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        
                    },
                    'buttons' => [

                        //view button
                        'delete' => function ($url, $model) {
                            return Button::widget(['id' => 'lsd-del-' . $model['id'],
                                'widgetClass' => 'button-link list-ship-delete',
                                'text' => '<span class="glyphicon glyphicon-remove"></span>',
                                'options' => [
                                    'data-ship-id' => $model['id']
                                ],
                                'color' => Button::NONE_COLOR]);
                        },
                        'edit' => function($url, $model) {
                            return Button::widget(['id' => 'lsd-edit-' . $model['id'],
                                'widgetClass' => 'button-link list-ship-edit',
                                'text' => '<span class="glyphicon glyphicon-edit"></span>',
                                'options' => [
                                    'data-ship-id' => $model['id']
                                ],
                                'color' => Button::NONE_COLOR]);
                        }
                    ],

                ]
            ]
        ]) ?>

</div>