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
                    . '/ship/p-create', 
        'widget_class' => 'form co-form' , 'enable_button' => false
        ]) ?>   
        
    <?= InputField::widget(['id' => $id . '-name', 'placeholder' => 'Nama Kapal', 
        'newClass' => 'form-field',
        'name' => 'name']) ?>
    
    <?= TextAreaField::widget(['id' => $id . '-desc', 'placeholder' => 'Keterangan', 
        'newClass' => 'form-field',
        'rows' => 3, 'name' => 'description']) ?>

    <?= InputField::widget(['id' => $id . '-code', 'placeholder' => 'Kode Kapal',
        'name' => 'code', 'newClass' => 'form-field']) ?>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
