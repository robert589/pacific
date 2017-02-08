<?php
    use common\widgets\Form;
    use common\widgets\SearchField;
    use common\widgets\InputField;
    use common\widgets\Button;

?>

<?php Form::begin([
    'id' => $id,
    'widget_class' => 'custom-report-form',
    'enable_button' => false,
    'url' => \Yii::$app->request->baseUrl . '/report/get-report-view'
]) ?>
    <?= SearchField::widget(['id' => $id . '-ship', 
                            'url' => \Yii::$app->request->baseUrl . '/ship/search',
                            'placeholder' => 'Cari Kapal',
                            'name' => 'ship_id']) ?>

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