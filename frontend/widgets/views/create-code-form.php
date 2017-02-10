<?php
    use common\widgets\Form;
    use common\widgets\InputField;
    use common\widgets\TextAreaField;
    use common\widgets\Button;
    use common\widgets\SearchField;
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/code/p-create', 
        'widget_class' => 'form ccode-form' , 'enable_button' => false
        ]) ?>   
        

    <?= InputField::widget(['id' => $id . '-id', 'placeholder' => 'Id', 'name' => 'id']) ?>
    
    <?= InputField::widget(['id' => $id . '-name', 'placeholder' => 'Nama', 'name' => 'name']) ?>
    
    <?= TextAreaField::widget(['id' => $id . '-desc', 'placeholder' => 'Keterangan', 'rows' => 3, 'name' => 'description']) ?>

    <?= SearchField::widget(['id' => $id . '-type-id', 'placeholder' => 'Cari Tipe', 
                'url' => \Yii::$app->request->baseUrl . "/code/search-type", 'name' => 'type_id']) ?>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
