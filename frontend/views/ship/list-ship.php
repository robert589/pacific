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
                'description'
            ]
        ]) ?>

</div>