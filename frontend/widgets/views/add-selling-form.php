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
        'widget_class' => 'form as-form' , 'enable_button' => false
        ]) ?>   
    <div class="form-field">
        <div class="form-field-left">
            Keterangan
        </div>
        <?= InputField::widget(['id' => $id . '-remark', 'placeholder' => 'Keterangan', 
                               'name' => 'remark', 'type' => InputField::TEXT]) ?>
    </div>


    <div class="form-field as-form-price" id="<?= $id . 'price-el' ?>">
        <div class="form-field-left">
            Harga
        </div>
        <?= InputField::widget(['id' => $id . '-price', 'placeholder' => 'Harga', 'value' => 0,
                                'type' => InputField::NUMBER, 'name' => 'price']) ?>
    </div>

    <div class="form-field" id="<?= $id. 'tonase-el' ?>">
        <div class="form-field-left">
            Tonase
        </div>  
        <?= InputField::widget(['id' => $id . '-tonase', 'placeholder' => 'Tonase', 'value' => 0,
                                'type' => InputField::NUMBER, 'name' => 'tonase']) ?>
    </div>

    <div class="form-field as-form-total app-hide" id="<?= $id . 'total-el' ?>">
        <div class="form-field-left">
            Total
        </div>
        <?= InputField::widget(['id' => $id . '-total', 'placeholder' => 'Total', 'value' => 0,
                                'type' => InputField::NUMBER, 'name' => 'total']) ?>
    </div>

    <?= InputField::widget(['id' => $id . '-ship', 'type' => InputField::HIDDEN, 'name' => 'ship_id', 'value' => $shipId]) ?>

    <?= InputField::widget(['id' => $id . '-date', 'type' => InputField::HIDDEN, 'name' => 'date', 'value' => $date]) ?>
    <?= Button::widget(['id' => $id . '-switch' , 
        'text' => '<span class="glyphicon glyphicon-refresh"></span>', 
        'widgetClass' => 'button-link', 'newClass' => 'as-form-switch',
        'color' => Button::NONE_COLOR]) ?>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => '<span class="glyphicon glyphicon-plus"></span>']) ?>
<?php Form::end() ?>
