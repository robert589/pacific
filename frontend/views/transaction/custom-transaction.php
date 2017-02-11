<?php
    use common\widgets\InputField;
    use common\widgets\SearchField;
    use common\widgets\Button;
    use frontend\widgets\CustomTransactionForm;

?>

<div id="<?= $id ?>" class="custom-transaction view">
    <div class="view-header">
        Kustom Transaksi
    </div>
    
    <?= CustomTransactionForm::widget(['id' => $id . '-form']) ?>
    
    <div class="custom-transaction-area">
        
    </div>
</div>