<?php
    use common\widgets\Form;
    use common\widgets\InputField;
    use common\widgets\TextAreaField;
    use common\widgets\Button;
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/code/p-create-type', 
        'widget_class' => 'form cct-form' , 'enable_button' => false
        ]) ?>   
    <?= InputField::widget(['id' => $id . '-name', 'placeholder' => 'Nama', 'name' => 'name']) ?>
    
    <?= TextAreaField::widget(['id' => $id . '-desc', 'placeholder' => 'Keterangan', 'rows' => 3, 'name' => 'description']) ?>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>