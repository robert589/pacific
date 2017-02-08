<?php
    use yii\grid\GridView;
?>

<?=  GridView::widget(
        ['dataProvider' => $provider,
         'columns' => [
            'id',
            'name'
        ]
    ]) ?>
