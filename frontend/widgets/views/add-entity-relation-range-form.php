<?php
    use common\widgets\Form;
    use common\widgets\InputField;
    use common\widgets\SearchField;
    use common\widgets\TextAreaField;
    use common\widgets\Button;
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/code/add-relation-range', 
        'widget_class' => 'form aerr-form' , 'enable_button' => false
        ]) ?>   
    <div class="form-field">
        <div class="form-field-left">
            Tambah Banyak Kode
        </div>
        <div class="form-flex">
            <?= InputField::widget(['id' => $id . '-from', 'name' =>  'from', 'placeholder' => 'Dari', 'type' => InputField::NUMBER]) ?>
            <?= InputField::widget(['id' => $id . '-to', 'name' =>  'to', 'placeholder' => 'Sampai', 'type' => InputField::NUMBER]) ?>

        </div>
    </div>
    
    <?= InputField::widget(['id' => $id. '-code', 'value' => $code, 'name' => 'code', 'type' => InputField::HIDDEN]) ?>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Tambah']) ?>
<?php Form::end() ?>
