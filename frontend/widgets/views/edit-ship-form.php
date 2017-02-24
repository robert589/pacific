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
                    . '/ship/p-edit', 
        'widget_class' => 'form es-form' , 'enable_button' => false
        ]) ?>   
        
    <?= InputField::widget(['id' => $id . '-name', 'placeholder' => 'Nama Kapal', 
        'newClass' => 'form-field', 'value' => $vo->getName(),
        'name' => 'name']) ?>
    
    <?= TextAreaField::widget(['id' => $id . '-desc', 'placeholder' => 'Keterangan', 
        'newClass' => 'form-field', 'value' => $vo->getDescription(),
        'rows' => 3, 'name' => 'description']) ?>


        
    <?= InputField::widget(['id' => $id . '-code', 'placeholder' => 'Kode Kapal',
        'name' => 'code', 'value' => $vo->getCode(), 'newClass' => 'form-field']) ?>
        
    <?= InputField::widget(['id' => $id . '-id',
        'name' => 'id', 'value' => $vo->getId(), 'type' => InputField::HIDDEN]) ?>
        
    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
