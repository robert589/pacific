<?php
    use frontend\widgets\CustomSellingForm;
?>

<div id="<?= $id ?>" class="custom-selling view">
    <div class="view-header">
        Laporan Custom
    </div>
    
    <?= CustomSellingForm::widget(['id' => $id . '-form']) ?>
    
    <div class="custom-selling-area">
        
    </div>
</div>