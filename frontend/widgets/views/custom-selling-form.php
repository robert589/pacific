<?php
    use common\widgets\Form;
    use common\widgets\SearchField;
    use common\widgets\InputField;
    use common\widgets\Button;

?>

<?php Form::begin([
    'id' => $id,
    'widget_class' => 'custom-selling-form',
    'enable_button' => false,
    'url' => \Yii::$app->request->baseUrl . '/selling/get-selling-view'
]) ?>
    <?= SearchField::widget(['id' => $id . '-entity', 
                            'url' => \Yii::$app->request->baseUrl . '/code/search',
                            'placeholder' => 'Cari Kode',
                            'name' => 'entity_id']) ?>

    <?= InputField::widget(['id' => $id . '-from',
                            'datepicker' => true, 
                            'type' => 'text',
                            'name' => 'from', 'placeholder' => 'From']) ?>

    <?= InputField::widget(['id' => $id . '-to',
                            'datepicker' => true, 
                            'type' => 'text',
                            'name' => 'to', 'placeholder' => 'To']) ?>

    <?= Button::widget(['id' => $id . '-submit-btn', 'text' => 'GET']) ?>
<?php Form::end() ?>