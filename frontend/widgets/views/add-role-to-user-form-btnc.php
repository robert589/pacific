<?php
    use common\widgets\BtnContainer;
    use common\widgets\Form;
    use frontend\widgets\AddRoleToUserForm;
?>

<?php BtnContainer::begin([
        'id' => $id,
        'btnText' => 'Tambah Peran',
        'btnNewClass' => 'artuf-btnc button-link',
        'newClass' => $newClass,
        'color' => 'none'
    ]); ?>

    <?= AddRoleToUserForm::widget(['id' => $id . '-form', 'userId' => $userId]) ?>

<?php BtnContainer::end(); ?>