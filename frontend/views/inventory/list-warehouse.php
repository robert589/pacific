<?php
    use frontend\vos\RoleVo;
    use common\widgets\Button;
    use yii\grid\GridView;
    use frontend\widgets\AddRoleToUserFormBtnc;
?>
<div id="<?= $id ?>" class="list-warehouse view">
    <div class="view-header">
        Daftar Warehouse
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Warehouse', 'newClass' => 'view-header-btn']) ?>
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
                    'template' => '{add}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        
                    },
                    'buttons' => [
                        //view button
                        'add' => function ($url, $model) {
                            if($model['active']) {
                                return AddRoleToUserFormBtnc::widget(
                                        ['id' => 'artufb-' . $model['id'],  
                                            'userId' => $model['id'],
                                            'newClass' => 'list-user-artufb']);
                            }
                        }
                    ],

                ]

            ]
        ]); ?>
    
</div>