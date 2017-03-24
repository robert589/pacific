<?php 
    use common\widgets\SearchField;
    use common\widgets\InputField;
    use common\widgets\Button;
?>
<div id="<?= $id ?>" class="daily-transact view">
    <div class="view-header">
        Transaksi Harian
    </div>
    
    <div class="daily-transact-header">
        
        <?= InputField::widget(['id' => $id . '-date',
                                'datepicker' => true,
                                'type' => 'text',
                                'name' => 'date', 'placeholder' => 'Tanggal']) ?>
        
        <?= Button::widget(['id' => $id . '-refresh', 'disabled' => true,
                            'text' => 'Refresh', 'newClass' => 'daily-transact-refresh']) ?>
    </div>
    
    <div class="daily-transact-area">
            
    </div>
</div>