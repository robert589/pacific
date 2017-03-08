<?php
    use common\widgets\Button;
    use frontend\widgets\AssignRightsToRoleFormBtnc;
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
                'status',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Actions',    
                    'template' => '{add_rights}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        
                    },
                    'buttons' => [
                        //view button
                        'add_rights' => function ($url, $model) {
                            if($model['active']) {
                                return AssignRightsToRoleFormBtnc::widget(
                                        ['id' => 'artrfb-' . $model['id'],  
                                            'roleId' => $model['id'],
                                            'newClass' => 'list-role-artrfbs']);
                            }
                        }
                    ],

                ]
            ]
        ]); ?>
    
</div>