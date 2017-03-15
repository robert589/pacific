<?php
    use common\widgets\Form;
    use common\widgets\InputField;
    use common\widgets\TextAreaField;
    use common\widgets\Button;
    use common\widgets\SearchField;
    use common\widgets\CurrencyField;
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/selling/p-create', 
        'widget_class' => 'form as-form' , 'enable_button' => false
        ]) ?>   
    <div class="form-field as-form-price" id="<?= $id . 'price-el' ?>">
        <div class="form-field-left">
            Harga
        </div>
        <?= CurrencyField::widget(['id' => $id . '-price', 'defaultValue' => 0,
                                'name' => 'price']) ?>
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
        <?= CurrencyField::widget(['id' => $id . '-total', 'defaultValue' =>  0,
                                    'name' => 'total']) ?>
    </div>

    <?= Button::widget(['id' => $id . '-switch' , 
        'text' => '<span class="glyphicon glyphicon-refresh"></span>', 
        'widgetClass' => 'button-link', 'newClass' => 'as-form-switch',
        'color' => Button::NONE_COLOR]) ?>

    <div class="form-field">
        <div class="form-field-left">
            Pembeli
        </div>
        <?= SearchField::widget(['id' => $id . '-buyer', 'placeholder' => 'Cari Pembeli', 
                               'name' => 'buyer_id', 'url' => \Yii::$app->request->baseUrl . "/code/search"]) ?>
    </div>

    <div class="form-field">
        <div class="form-field-left">
            Keterangan
        </div>
        <?= InputField::widget(['id' => $id . '-remark', 'placeholder' => 'Keterangan', 
                               'name' => 'remark', 'type' => InputField::TEXT]) ?>
    </div>

    <?= InputField::widget(['id' => $id . '-product', 'type' => InputField::HIDDEN, 'name' => 'product_id', 'value' => $productId]) ?>

    <?= InputField::widget(['id' => $id . '-date', 'type' => InputField::HIDDEN, 'name' => 'date', 'value' => $date]) ?>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => '<span class="glyphicon glyphicon-plus"></span>']) ?>
<?php Form::end() ?>
