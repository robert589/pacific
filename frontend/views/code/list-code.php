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
            ['dataProvider' => $provider,
             'columns' => [
                'id',
                'name',
                'description'
            ]
        ]) ?>

</div>