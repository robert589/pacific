<?php
    use frontend\widgets\AddReportForm;
    use frontend\widgets\TransactionItem;
?>

<div id="<?= $id ?>" class="transaction-view">
    <div class="transaction-view-area">
        <div class="transaction-view-header">
            
            <div class="transaction-view-header-field">
                Tanggal
            </div>
            <div class="transaction-view-header-field">
                Kode
            </div>
            <div class="transaction-view-header-field">
                Keterangan
            </div>
            <div class="hide600 transaction-view-header-field">
                Debet
            </div>
            <div class="hide600 transaction-view-header-field">
                Kredit
            </div>
            <div class="transaction-view-header-field">
                Saldo
            </div>
        </div>
        <?php foreach($vos as $vo ) { ?>
            <?= TransactionItem::widget(['id' => $id . '-' . $vo->getId(), 'vo' => $vo]) ?>
        <?php } ?>
    </div>
    <div class="transaction-view-footer">
        <div class="transaction-view-footer-item3">
            Saldo Total
        </div>
        <div class="transaction-view-footer-item2">
            <?= $totalSaldo ?>
        </div>
    </div>    
    
</div>