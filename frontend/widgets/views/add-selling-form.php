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
        
    <div class="form-field">
        <div class="form-field-left">
            Date
        </div>
        <?= InputField::widget(['id' => $id . '-date',
                        'datepicker' => true, 
                        'type' => 'text',
                        'name' => 'date', 'placeholder' => 'Tanggal']) ?>

    </div>
    <div class="form-field">
        <div class="form-field-left">
            Produk
        </div>
        <?= SearchField::widget(['id' => $id . '-product', 
                                'url' => \Yii::$app->request->baseUrl . '/code/search',
                                'placeholder' => 'Cari Produk',
                                'name' => 'product_id']) ?>
    </div>
    <div class="form-field">
        <div class="form-horizontal as-form-price" id="<?= $id . 'price-el' ?>">
            <div class="form-field-left">
                Harga
            </div>
            <?= CurrencyField::widget(['id' => $id . '-price', 'defaultValue' => 0,
                                    'disabled' => true,
                                    'name' => 'price']) ?>
        </div>

        <div class="form-horizontal" id="<?= $id. 'tonase-el' ?>">
            <div class="form-field-left">
                Unit
            </div>  
            <?= InputField::widget(['id' => $id . '-unit', 'placeholder' => 'Unit', 'value' => 0,
                                    'disabled' => true,
                                    'type' => InputField::NUMBER, 'name' => 'unit']) ?>
        </div>
        
        <div class="form-horizontal">
            <div class="form-field-left">
                Total
            </div>  
            <?= CurrencyField::widget(['id' => $id . '-total', 'defaultValue' => 0,
                                    'disabled' => true,
                                    'name' => 'total']) ?>
        </div>

    </div>

    <div class="form-field">
        <div class="form-field-left">
            Warehouse
        </div>
        <?= SearchField::widget(['id' => $id . '-warehouse', 
                                'placeholder' => 'Cari Warehouse', 
                                'name' => 'warehouse_id', 
                                'disabled' => true,
                                'url' => \Yii::$app->request->baseUrl . "/inventory/search-selling-wh"]) ?>
    </div>
    
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
    
    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add']) ?>

    <div class="as-form-status">
        
    </div>
<?php Form::end() ?>
