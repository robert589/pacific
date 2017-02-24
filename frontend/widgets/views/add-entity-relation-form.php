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
                    . '/code/add-entity', 
        'widget_class' => 'form aer-form' , 'enable_button' => false
        ]) ?>   
    <div class="form-field">
        <div class="form-field-left">
            Tambah Sub Kode
        </div>
        <?= SearchField::widget(['id' => $id . '-subcode', 'placeholder' => 'Cari Sub Kode',
                               'name' => 'subcode', 'url' => \Yii::$app->request->baseUrl . '/code/search']) ?>
    </div>
    
    <?= InputField::widget(['id' => $id. '-code', 'value' => $code, 'name' => 'code', 'type' => InputField::HIDDEN]) ?>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Tambah']) ?>
<?php Form::end() ?>
