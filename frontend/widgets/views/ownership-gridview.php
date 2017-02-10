<?php
    use yii\grid\GridView;
    use common\widgets\Button;
?>

<?=  GridView::widget(
        ['dataProvider' => $provider,
        'id' => $id,
         'columns' => [
            'id',
            'name',
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Actions',    
                'template' => '{delete}',
                'urlCreator' => function ($action, $model, $key, $index) {

                },
                'buttons' => [

                    //view button
                    'delete' => function ($url, $model) {
                        return Button::widget(['id' => 'owngv-del-' . $model['id'],
                            'widgetClass' => 'button-link own-gv-delete',
                            'text' => '<span class="glyphicon glyphicon-remove"></span>',
                            'options' => [
                                'data-owner-id' => $model['id'],
                                'data-ship-id' => $model['ship_id']
                            ],
                            'color' => Button::NONE_COLOR]);
                    }
                ],

            ]

        ]
    ]) ?>
