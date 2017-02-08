
<?php
    use common\widgets\InputField;
    use common\widgets\Button;
    use common\widgets\Form;
?>

<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl . '/site/login', 
        'widget_class' => 'form-horizontal login-form' , 'enable_button' => false
        ]) ?>
    <div class="login-form-field">
        <?= InputField::widget(['id' => $id . '-email-field', 
                        'type' => InputField::EMAIL, 'name' => 'email', 'value' => null, 'placeholder' => 'Enter Email' ]) ?>
    </div>
    <div class="login-form-field">
        <?= InputField::widget(['id' => $id .'-password-field' , 
                                'type' => InputField::PASSWORD, 
                                'name' => 'password', 'value' => null, 
                                'placeholder' => 'Enter Password']) ?>
    </div>
    <?= Button::widget(['id' => $id . '-submit-btn' , 'text' => 'Login', 'newClass' => 'login-form-submit']) ?>
<?php Form::end() ?>

