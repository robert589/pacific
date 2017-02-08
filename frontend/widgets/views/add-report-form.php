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
                    . '/report/p-create', 
        'widget_class' => 'form ar-form' , 'enable_button' => false
        ]) ?>   
    <div class="form-field">
        <div class="form-field-left">
            Remark
        </div>
        <?= InputField::widget(['id' => $id . '-remark', 'placeholder' => 'Keterangan', 
                               'name' => 'remark', 'type' => InputField::TEXT]) ?>
    </div>


    <div class="form-field">
        <div class="form-field-left">
            Debet
        </div>
        <?= InputField::widget(['id' => $id . '-debet', 'placeholder' => 'Debet', 'value' => 0,
                                'type' => InputField::NUMBER, 'name' => 'debet']) ?>
    </div>

    <div class="form-field">
        <div class="form-field-left">
            Credit
        </div>
        <?= InputField::widget(['id' => $id . '-credit', 'placeholder' => 'Credit', 'value' => 0,
                                'type' => InputField::NUMBER, 'name' => 'credit']) ?>
    </div>

    <?= InputField::widget(['id' => $id . '-ship', 'type' => InputField::HIDDEN, 'name' => 'ship_id', 'value' => $shipId]) ?>

    <?= InputField::widget(['id' => $id . '-date', 'type' => InputField::HIDDEN, 'name' => 'date', 'value' => $date]) ?>
    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => '<span class="glyphicon glyphicon-plus"></span>']) ?>
<?php Form::end() ?>
