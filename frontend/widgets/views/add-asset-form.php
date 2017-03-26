    <?php
    use common\models\Asset;
    use common\widgets\DropdownField;
    use common\widgets\CheckboxField;
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
                    . '/inventory/p-create-asset', 
        'widget_class' => 'form asset-form' , 'enable_button' => false
        ]) ?>   
              
    <div class="form-field">
        <?= InputField::widget(['id' => $id . '-code', 
            'placeholder' => 'Kode', 'name' => 'code']) ?>
    </div>
    <div class="form-field">
        <?= InputField::widget(['id' => $id . '-name', 
            'placeholder' => 'Nama', 'name' => 'name']) ?>
    </div>

    <div class="form-field">
        <?= TextAreaField::widget(['id' => $id . '-desc', 'placeholder' => 'Keterangan',
            'rows' => 3, 'name' => 'description']) ?>
    </div>
    <div class="form-field">
        <?= SearchField::widget(['id' => $id . '-type-id', 'placeholder' => 'Cari Tipe', 
                'url' => \Yii::$app->request->baseUrl . "/code/search-type", 
            'name' => 'type_id']) ?>
    </div>
    <div class="form-field">
        <div class="form-field-left">
            Method
        </div>
        <div class="form-horizontal">
            <?=  DropdownField::widget(['id' => $id . '-method', 
                'items' => Asset::getTypes(),
                'placeholder' => 'LIFO/FIFO',
                'name' => 'method']) ?>
         </div>
    </div>
    <div class="form-field">
        <?= CheckboxField::widget(['id' => $id . '-fixed-asset', 
            'item' => "Fixed Asset",
            'name' => 'fixed_asset']) ?>
    </div>
    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-horizontal']) ?>

    <div class="asset-form-status">
    </div>
<?php Form::end() ?>
