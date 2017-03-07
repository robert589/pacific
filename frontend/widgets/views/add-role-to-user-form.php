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
                    . '/user/assign-role', 
        'widget_class' => 'form artu-form' , 'enable_button' => false
        ]) ?>   
        
    <div class="form-field">
        <?= InputField::widget(['id' => $id . '-user-id',
            'type' => InputField::HIDDEN,
            'value' => $userId,
            'name' => 'target_user_id']) ?>
    </div>

    <div class="form-field">
        <?= SearchField::widget(['id' => $id . '-role', 'placeholder' => 'Assign Role', 
            'url' => \Yii::$app->request->baseUrl . '/user/search-role',
            'name' => 'role_id']) ?>
    </div>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
