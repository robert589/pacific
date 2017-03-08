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
                    . '/user/assign-access', 
        'widget_class' => 'form artr-form' , 'enable_button' => false
        ]) ?>   
        
    <div class="form-field">
        <?= InputField::widget(['id' => $id . '-role-id',
            'type' => InputField::HIDDEN,
            'value' => $roleId,
            'name' => 'role_id']) ?>
    </div>

    <div class="form-field">
        <?= SearchField::widget(['id' => $id . '-rights', 'placeholder' => "Cari Hak Akses", 
            'url' => \Yii::$app->request->baseUrl . '/user/search-rights',
            'name' => 'access_control_id']) ?>
    </div>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
