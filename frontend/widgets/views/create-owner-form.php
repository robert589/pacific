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
                    . '/owner/p-create', 
        'widget_class' => 'form co-form' , 'enable_button' => false
        ]) ?>   

    <div class="form-flex">
        <?=  InputField::widget(['id' => $id . '-first-name', 'placeholder' => 'Nama Depan', 'name' => 'first_name']) ?>
        <?=  InputField::widget(['id' => $id . '-last-name', 'placeholder' => 'Nama Belakang', 'name' => 'last_name']) ?>
    </div>

    <?= InputField::widget(['id' => $id. '-email', 'name' => 'email', 'placeholder' => 'Email', 'type' => 'email']) ?>
    <?= InputField::widget(['id' => $id . '-password', 'name' => 'password', 'placeholder' => 'Password', 'type' => 'password']) ?>
    <?= InputField::widget(['id' => $id . '-telephone', 'placeholder' => 'Nomor telepon', 'name' => 'telephone']) ?>
    
    <?= TextAreaField::widget(['id' => $id . '-address', 'placeholder' => 'Alamat', 'rows' => 3, 'name' => 'address']) ?>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
