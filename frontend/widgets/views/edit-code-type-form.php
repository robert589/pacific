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
                    . '/code/p-edit-type', 
        'widget_class' => 'form ect-form' , 'enable_button' => false
        ]) ?>   
    <div class="form-field">
        <?= InputField::widget(['id' => $id . '-name', 'placeholder' => 'Nama', 'name' => 'name',
                                'value' => $vo->getName()]) ?>
    </div>
    
    <div class="form-field">
        <?= TextAreaField::widget(['id' => $id . '-desc', 'placeholder' => 'Keterangan',
                                    'rows' => 3, 'name' => 'description',
                                    'value' => $vo->getDescription()]) ?>
    </div>
                                

    <?= InputField::widget(['id' => $id . '-id', 'type' => InputField::HIDDEN, 'name' => 'entity_type_id',
                            'value' => $vo->getId()]) ?>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Edit', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
