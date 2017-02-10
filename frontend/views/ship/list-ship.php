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
                'id',
                'name',
                'description',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Actions',    
                    'template' => '{delete}',
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
                        }
                    ],

                ]
            ]
        ]) ?>

</div>