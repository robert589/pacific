<?php
    use frontend\vos\RoleVo;
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
                    'header'=>'Roles',    
                    'template' => '{roles}',
                    'buttons' => [
                        //view button
                        'roles' => function ($url, $model) {
                            /* @var $roles RoleVo[] */
                            $roles = $model['roles'];
                            $views = "";
                            foreach($roles as $role) {
                                $name = $role->getName();
                                $view = "<span class='list-user-remove-role'>$name";
                                $view .= Button::widget(['id' => 'list-user' . $model['id'] . $role->getId(), 
                                                'newClass' => 'list-user-remove-role-btn',
                                                'color' => Button::NONE_COLOR,
                                                'text' => "<span class='glyphicon glyphicon-remove'></span>",
                                                'options' => [
                                                    'data-user-id' => $model['id'],
                                                    'data-role-id' => $role->getId()
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
                    'template' => '{add_role}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        
                    },
                    'buttons' => [
                        //view button
                        'add_role' => function ($url, $model) {
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