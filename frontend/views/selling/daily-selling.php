<?php
    use common\widgets\SearchField;
    use frontend\widgets\AddSellingFormModal;
    use common\widgets\InputField;
    use common\widgets\Button;
?>
<div id="<?= $id ?>" class="daily-selling view">
    <div class="view-header">
        Penjualan Harian    
    </div>
    
    <?=    AddSellingFormModal::widget(['id' => $id . '-asf-modal']) ?>
    
    <div class="daily-selling-header">
        <?= InputField::widget(['id' => $id . '-date',
                                'datepicker' => true, 
                                'type' => 'text',
                                'name' => 'date', 'placeholder' => 'Tanggal']) ?>
        
        <?= Button::widget(['id' => $id . '-asf-modal-btn', 'disabled' => true,
                            'text' => 'Tambah Penjualan', 'newClass' => 'daily-selling-sas']) ?>
    </div>
    
    <div class="daily-selling-area">
            
    </div>
</div>