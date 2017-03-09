<?php
    use common\widgets\Button;
    use frontend\vos\AccessControlVo;
    use frontend\widgets\AssignRightsToRoleFormBtnc;
    use yii\grid\GridView;
?>
<div id="<?= $id ?>" class="list-ac view">
    <div class="view-header">
        Daftar Hak Akses
    </div>

    <?=  GridView::widget(
        [   'dataProvider' => $provider,
            'columns' => [
                'id',
                'name',
                'description',
                'code'
            ]
        ]); ?>
    
</div>