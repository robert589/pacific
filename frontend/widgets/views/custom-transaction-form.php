<?php
    use common\widgets\Form;
    use common\widgets\CheckboxField;
    use common\widgets\SearchField;
    use common\widgets\InputField;
    use common\widgets\Button;

?>

<?php Form::begin([
    'id' => $id,
    'widget_class' => 'custom-transaction-form',
    'enable_button' => false,
    'url' => \Yii::$app->request->baseUrl . '/transaction/get-transaction-view'
]) ?>
    <div class="custom-transaction-form-action">
        <?=     CheckboxField::widget(['id' => $id . '-show-date', 'checked' => 1,
                                    'item' => 'Tanggal', 'name' => 'show_date']) ?>
        
        <?=     CheckboxField::widget(['id' => $id . '-show-code', 'name' => 'show_code',
                        'checked' => 1, 'item' => 'Kode']) ?>
        
        <?=     CheckboxField::widget(['id' => $id . '-show-remark', 'name' => 'show_remark',
                        'checked' => 1, 'item' => 'Keterangan']) ?>
        
        <?=     CheckboxField::widget(['id' => $id . '-show-debet', 'name' => 'show_debet',
                        'checked' => 1, 'item' => 'Debet']) ?>
        
        <?=     CheckboxField::widget(['id' => $id . '-show-credit', 'name' => 'show_credit',
                        'checked' => 1, 'item' => 'Kredit']) ?>
        
        <?=     CheckboxField::widget(['id' => $id . '-show-saldo', 'checked' => 1,
                        'item' => 'Saldo', 'name' => 'show_saldo']) ?>
    </div>

    <div class="custom-transaction-form-view">
        <?= SearchField::widget(['id' => $id . '-code', 
                                'url' => \Yii::$app->request->baseUrl . '/code/search',
                                'placeholder' => 'Cari Kode',
                                'name' => 'entity_id']) ?>

        <?= InputField::widget(['id' => $id . '-from',
                                'datepicker' => true, 
                                'type' => 'text',
                                'name' => 'from', 'placeholder' => 'From']) ?>

        <?= InputField::widget(['id' => $id . '-to',
                                'datepicker' => true, 
                                'type' => 'text',
                                'name' => 'to', 'placeholder' => 'To']) ?>

        <?= Button::widget(['id' => $id . '-submit-btn', 'text' => 'GET']) ?>
        
    </div>
<?php Form::end() ?>