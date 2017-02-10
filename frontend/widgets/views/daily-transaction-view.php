<?php
    use frontend\widgets\AddTransactionForm;
    use frontend\widgets\DailyTransactionItem;
?>

<div id="<?= $id ?>" class="dt-view">
    <div class="dt-view-area">
        <div class="dt-view-header">
            <div class="dt-view-header-field">
                Kode
            </div>
            <div class="dt-view-header-field">
                Debet
            </div>
            <div class="dt-view-header-field">
                Kredit
            </div>
            <div class="dt-view-header-field">
                Saldo
            </div>
            <div class="dt-view-header-field">
                Keterangan
            </div>
            <div class="dt-view-header-field">
                Aksi
            </div>
            
        </div>
        <?php foreach($vos as $vo ) { ?>
            <?= DailyTransactionItem::widget(['id' => $id . '-' . $vo->getId(), 'vo' => $vo]) ?>
        <?php } ?>
    </div>
    <div class="dt-view-footer">
        <div class="dt-view-footer-item3">
            Transaksi Harian
        </div>
        <div class="dt-view-footer-item2">
            <?= $dailySaldo ?>
        </div>
    </div>
    
    <?= AddTransactionForm::widget(['id' => $id . '-atform',
        'date' => $date]) ?>  
</div>