<?php
    use common\widgets\BtnContainer;
    use common\widgets\Form;
    use frontend\widgets\AddRoleToUserForm;
?>

<?php BtnContainer::begin([
        'id' => $id,
        'btnText' => 'Tambah Peran',
        'newClass' => 'artuf-btnc'
    ]); ?>

    <?= AddRoleToUserForm::widget(['id' => $id . '-form']) ?>

<?php BtnContainer::end(); ?>