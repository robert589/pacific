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
                    . '/inventory/p-add-wh', 
        'widget_class' => 'form add-wh-form' , 'enable_button' => false
        ]) ?>   
        
    <div class="form-field">
        <?= InputField::widget(['id' => $id . '-code', 'placeholder' => 'Kode', 'name' => 'code']) ?>
    </div>
    <div class="form-field">
        <?= InputField::widget(['id' => $id . '-name', 'placeholder' => 'Nama', 'name' => 'name']) ?>
    </div>

    <div class="form-field">
        <?= TextAreaField::widget(['id' => $id . '-desc', 'placeholder' => 'Keterangan', 'rows' => 3, 'name' => 'description']) ?>
    </div>

    <div class="form-field">
        <?= TextAreaField::widget(['id' => $id . '-location', 'placeholder' => 'Lokasi', 'rows' => 3, 'name' => 'location']) ?>
    </div>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
