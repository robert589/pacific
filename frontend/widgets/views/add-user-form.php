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
                    . '/user/p-add', 
        'widget_class' => 'form au-form' , 'enable_button' => false
        ]) ?>   

    <div class="form-field form-flex">
        <?=  InputField::widget(['id' => $id . '-first-name', 'placeholder' => 'Nama Depan', 'name' => 'first_name']) ?>
        <?=  InputField::widget(['id' => $id . '-last-name', 'placeholder' => 'Nama Belakang', 'name' => 'last_name']) ?>
    </div>
    
    <div class="form-field">
        <?= InputField::widget(['id' => $id. '-email', 'name' => 'email', 
                                'placeholder' => 'Email', 'type' => 'email']) ?>
    </div>
    <div class="form-field">
        <?= InputField::widget(['id' => $id . '-password', 'name' => 'password', 
                            'placeholder' => 'Password', 'type' => 'password']) ?>
    </div>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
