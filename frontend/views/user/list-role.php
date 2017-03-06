<?php
    use common\widgets\Button;
    use yii\grid\GridView;
?>
<div id="<?= $id ?>" class="list-role view">
    <div class="view-header">
        Daftar Peran
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Peran', 'newClass' => 'view-header-btn']) ?>
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