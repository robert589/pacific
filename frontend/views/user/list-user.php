<?php
    use common\widgets\Button;
    use yii\grid\GridView;
?>
<div id="<?= $id ?>" class="list-user view">
    <div class="view-header">
        Daftar Pengguna
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Pengguna', 'newClass' => 'view-header-btn']) ?>
    </div>

    <?=  GridView::widget(
        [   'dataProvider' => $provider,
            'columns' => [
                'id',
                'name',
                'status'
            ]
        ]); ?>
    
</div>