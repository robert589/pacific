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
                    . '/code/add-owner', 
        'widget_class' => 'form aotc-form' , 'enable_button' => false
        ]) ?>   
        
    <div class="form-field">
        <?= InputField::widget(['id' => $id . '-entity-id',
            'type' => InputField::HIDDEN,
            'value' => $entityId,
            'name' => 'entity_id']) ?>
    </div>

    <div class="form-field">
        <?= SearchField::widget(['id' => $id . '-user-id', 'placeholder' => 'Cari Pengguna', 
            'url' => \Yii::$app->request->baseUrl . '/user/search',
            'name' => 'target_user_id']) ?>
    </div>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
