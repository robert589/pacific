<?php
    use common\widgets\Button;
    use yii\grid\GridView;
    use frontend\widgets\AddRoleToUserFormBtnc;
?>
<div id="<?= $id ?>" class="list-user view">
    <div class="view-header">
        Daftar Pengguna
        <?= Button::widget(['id' => $id . '-role', 'text' => 'Daftar Role', 'newClass' => 'view-header-btn']) ?>
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Pengguna', 'newClass' => 'view-header-btn']) ?>
    </div>

    <?=  GridView::widget(
        [   'dataProvider' => $provider,
            'columns' => [
                'id',
                'name',
                'status',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Actions',    
                    'template' => '{add_role}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        
                    },
                    'buttons' => [
                        //view button
                        'add_role' => function ($url, $model) {
                            if($model['active']) {
                                return AddRoleToUserFormBtnc::widget(['id' => 'artufb-' . $model['id']]);
                            }
                        }
                    ],

                ]

            ]
        ]); ?>
    
</div>