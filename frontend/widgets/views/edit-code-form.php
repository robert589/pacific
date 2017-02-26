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
                    . '/code/p-edit', 
        'widget_class' => 'form ecode-form' , 'enable_button' => false
        ]) ?>   
        
    <div class="form-field">
        <?= InputField::widget(['id' => $id . '-code', 'placeholder' => 'Kode',     
            'value' => $vo->getCode(),
            'name' => 'code']) ?>
    </div>
    <div class="form-field">
    <?= InputField::widget(['id' => $id . '-name', 'value' => $vo->getName(),
                    'placeholder' => 'Nama', 'name' => 'name']) ?>
    </div>

    <div class="form-field">
    <?= TextAreaField::widget(['id' => $id . '-desc', 'value' => $vo->getDescription(),
                    'placeholder' => 'Keterangan', 'rows' => 3, 'name' => 'description']) ?>
    </div>
    <div class="form-field">
    <?= SearchField::widget(['id' => $id . '-type-id', 'placeholder' => 'Cari Tipe', 
                'index' => $vo->getEntityType()->getId(),
                'value' => $vo->getEntityType()->getName(),
                'url' => \Yii::$app->request->baseUrl . "/code/search-type", 'name' => 'type_id']) ?>
    </div>
    <?= InputField::widget(['id' => $id . '-id', 'placeholder' => 'Kode',     
            'value' => $vo->getId(), 'type' => InputField::HIDDEN,
            'name' => 'id']) ?>
    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
