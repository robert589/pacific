<?php
    use common\widgets\Form;
    use common\widgets\InputField;
    use common\widgets\TextAreaField;
    use common\widgets\Button;
    use common\widgets\CheckboxField;
    
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/inventory/p-edit-wh', 
        'widget_class' => 'form edit-wh-form' , 'enable_button' => false
        ]) ?>   
        
     <div class="form-field">
        <?= InputField::widget(['id' => $id . '-code',
                'value' => $vo->getEntity()->getCode(),
                'placeholder' => 'Kode', 'name' => 'code']) ?>
    </div>
    <div class="form-field">
        <?= InputField::widget(['id' => $id . '-name',
                    'value' => $vo->getEntity()->getName(),
                    'placeholder' => 'Nama', 'name' => 'name']) ?>
    </div>

    <div class="form-field">
        <?= TextAreaField::widget(['id' => $id . '-desc', 
            'value' => $vo->getEntity()->getDescription(),
            'placeholder' => 'Keterangan', 'rows' => 3, 'name' => 'description']) ?>
    </div>

    <div class="form-field">
        <?= TextAreaField::widget(['id' => $id . '-location', 
            'value' => $vo->getLocation(),
            'placeholder' => 'Lokasi', 'rows' => 3, 'name' => 'location']) ?>
    </div>

    <div class="form-field">
        <?= CheckboxField::widget(['id' => $id . '-selling-place', 
            'checked' => $vo->isSellingPlace(),
            'name' => 'selling_place',
            'item' => 'Selling Place']) ?>
    </div>


    <?= InputField::widget(['id' => $id . '-id',
                'value' => $vo->getEntity()->getId(),
                'placeholder' => 'Id',
                'type' => InputField::HIDDEN,
                'name' => 'id']) ?>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
