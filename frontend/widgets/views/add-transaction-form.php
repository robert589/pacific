<?php
    use common\widgets\Form;
    use common\widgets\InputField;
    use common\widgets\CurrencyField;
    use common\widgets\Button;
    use common\widgets\SearchField;
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/transaction/p-create', 
        'widget_class' => 'form at-form' , 'enable_button' => false
        ]) ?>   

    <div class="form-field">
        <div class="form-field-left">
            Kode
        </div>
        <?= SearchField::widget(['id' => $id . '-code', 'placeholder' => 'Kode', 
            'url' => \Yii::$app->request->baseUrl . '/code/search',
            'name' => 'entity_id']) ?>
    </div>

    <div class="form-field">
        <div class="form-field-left">
            Debet
        </div>
        <?= CurrencyField::widget(['id' => $id . '-debet', 'defaultValue' => 0,  'name' => 'debet']) ?>
    </div>

    <div class="form-field">
        <div class="form-field-left">
            Credit
        </div>
        <?= CurrencyField::widget(['id' => $id . '-credit', 'defaultValue' => 0, 'name' => 'credit']) ?>
    </div>

    <div class="form-field">
        <div class="form-field-left">
            Remark
        </div>
        <?= InputField::widget(['id' => $id . '-remark', 'placeholder' => 'Keterangan', 
                               'name' => 'remark', 'type' => InputField::TEXT]) ?>
    </div>

    <?= InputField::widget(['id' => $id . '-date', 'type' => InputField::HIDDEN, 'name' => 'date', 'value' => $date]) ?>
    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => '<span class="glyphicon glyphicon-plus"></span>']) ?>
<?php Form::end() ?>
