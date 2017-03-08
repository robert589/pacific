<?php
    use common\widgets\BtnContainer;
    use common\widgets\Form;
    use frontend\widgets\AssignRightsToRoleForm;
?>

<?php BtnContainer::begin([
        'id' => $id,
        'btnText' => 'Tambah Hak Akses',
        'btnNewClass' => 'artrf-btnc button-link',
        'newClass' => $newClass,
        'color' => 'none'
    ]); ?>

    <?= AssignRightsToRoleForm::widget(['id' => $id . '-form', 'roleId' => $roleId]) ?>

<?php BtnContainer::end(); ?>