<?php
    use common\widgets\InputField;    use common\widgets\Button;
    use common\widgets\Form;
?>

<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl . '/user/process-change-password', 
        'widget_class' => 'form-horizontal cp-form' , 'enable_button' => false
        ]) ?>

    <div class="form-field">
        <div class="form-field-left">
            Current Password
        </div>
    
    <?= InputField::widget(
            ['id' => $id . '-cur-password-field',
                'name' => 'old_password', 'type' => InputField::PASSWORD ]) ?>
    
    </div>
    

            
    <?= Button::widget(['id' => $id . '-submit-btn' , 'text' => 'Assign', 'newClass' => 'form-submit']) ?>
    
<?php Form::end() ?>

