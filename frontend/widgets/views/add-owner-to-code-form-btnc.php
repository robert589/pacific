<?php
    use common\widgets\BtnContainer;
    use common\widgets\Form;
    use common\widgets\Button;
    use frontend\widgets\AddOwnerToCodeForm;
?>

<?php BtnContainer::begin([
        'id' => $id,
        'btnText' => 'Tambah Person In Charge',
        'btnNewClass' => 'aotcf-btnc',
        'color' => Button::RED_COLOR
    ]); ?>

    <?= AddOwnerToCodeForm::widget(['id' => $id . '-form', 'entityId' => $entityId]) ?>

<?php BtnContainer::end(); ?>