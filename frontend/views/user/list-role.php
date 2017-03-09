<?php
    use common\widgets\Button;
    use frontend\vos\AccessControlVo;
    use frontend\widgets\AssignRightsToRoleFormBtnc;
    use yii\grid\GridView;
?>
<div id="<?= $id ?>" class="list-role view">
    <div class="view-header">
        Daftar Peran
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Peran', 'newClass' => 'view-header-btn']) ?>
        <?= Button::widget(['id' => $id . '-list-ac', 'text' => 'Lihat Semua Hak Akses', 'newClass' => 'view-header-btn']) ?>

    </div>

    <?=  GridView::widget(
        [   'dataProvider' => $provider,
            'columns' => [
                'id',
                'name',
                'status',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Roles',    
                    'template' => '{roles}',
                    'buttons' => [
                        //view button
                        'roles' => function ($url, $model) {
                            /* @var $accessControlVos AccessControlVo[] */
                            $accessControlVos = $model['rights'];
                            $views = "";
                            foreach($accessControlVos as $vo) {
                                $name = $vo->getName();
                                $view = "<span class='list-role-remove-rights'>$name";
                                $view .= Button::widget(['id' => 'list-role' . $model['id'] . $vo->getId(), 
                                                'newClass' => 'list-role-remove-rights-btn',
                                                'color' => Button::NONE_COLOR,
                                                'text' => "<span class='glyphicon glyphicon-remove'></span>",
                                                'options' => [
                                                    'data-role-id' => $model['id'],
                                                    'data-right-id' => $vo->getId()
                                                ]]);
                                $view .= "</span>";
                                $views .= $view;
                            }
                            
                            return $views;
                        }
                    ],

                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Actions',    
                    'template' => '{add_rights}',
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