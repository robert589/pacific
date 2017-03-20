<?php
    use common\widgets\CurrencyField;
    use common\widgets\SearchField;
    use common\widgets\Form;
    use common\widgets\InputField;
    use common\widgets\TextAreaField;
    use common\widgets\Button;
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/purchase/p-add', 
        'widget_class' => 'form ap-form' , 'enable_button' => false
        ]) ?>   
    <div class="form-horizontal">
        <div class="form-field-left">
            Cari Barang (di Inventori)
        </div>
        <?= SearchField::widget(['id' => $id . '-code', 'placeholder' => 'Barang', 
                               'name' => 'entity_id', 
                                'url' => \Yii::$app->request->baseUrl . "/code/search-inventory"]) ?>
    </div>
   
    <div class="form-horizontal">
        <div class="form-field-left">
            Tanggal
        </div>
        <?= InputField::widget(['id' => $id . '-date', 'placeholder' => 'Tanggal', 
                               'name' => 'date', 'datepicker' => true]) ?>
    </div>
    <div class="form-horizontal">
        <div class="form-field-left">
            Quantity
        </div>
        <?= InputField::widget(['id' => $id . '-quantity', 'placeholder' => 'Kuantitas', 
                               'name' => 'quantity', 'type' => InputField::NUMBER]) ?>
    </div>

    <div class="form-horizontal">
        <div class="form-field-left">
            Cost (per Unit)
        </div>
        <?= CurrencyField::widget(['id' => $id . '-cost', 
                               'name' => 'unit_cost', 'defaultValue' => 0]) ?>
    </div>
    
    <div class="form-horizontal">
        <div class="form-field-left">
            Tanggal Kadaluarsa
        </div>
        <?= InputField::widget(['id' => $id . '-expiry-date', 'placeholder' => 'Expired Date', 
                               'name' => 'expiry_date', 'datepicker' => true]) ?>
    </div>
    <div class="form-horizontal">
        <div class="form-field-left">
            Warehouse
        </div>
    
        <?= SearchField::widget(['id' => $id . '-warehouse', 'placeholder' => 'Cari Warehouse', 
                               'name' => 'warehouse_id', 
                                'url' => \Yii::$app->request->baseUrl . "/inventory/search-warehouse"]) ?>
    </div>
    

    <?= Button::widget(['id' => $id . '-submit-btn' ,  'newClass' => 'form-submit2',
        'text' => 'Add']) ?>
<?php Form::end() ?>
