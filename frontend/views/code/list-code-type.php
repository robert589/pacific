<?php
    use common\widgets\Button;
    use yii\grid\GridView;
?>
<div id="<?= $id ?>" class="list-codetype view">
    <div class="view-header">
        Daftar Tipe Kode
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Tipe Kode', 'newClass' => 'view-header-btn']) ?>
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