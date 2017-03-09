<?php
    use frontend\widgets\AddReportForm;
    use frontend\widgets\TransactionItem;
    use common\widgets\Button;
?>

<div id="<?= $id ?>" class="transaction-view">
    <div class="transaction-view-action">
        <?= Button::widget(['id' => $id . '-printer', 
            'text' => '<span class="glyphicon glyphicon-print"></span>Print to Printer', 
            'color' => Button::BLUE_COLOR]) ?>
        
        <?= Button::widget(['id' => $id . '-piutang', 
            'text' => '<span class="glyphicon glyphicon-print"></span>Print as Piutang', 
            'color' => Button::RED_COLOR]) ?>
        
        <?= Button::widget(['id' => $id . '-utang', 
            'text' => '<span class="glyphicon glyphicon-print"></span>Print as Utang', 
            'color' => Button::RED_COLOR]) ?>
    </div>
    <div class="transaction-view-area">
        <div class="transaction-view-add-title">
            
        </div>
        <div class="transaction-view-title">
            Laporan: <?= $entityVo->getName() ?>
        </div>
        <div class="transaction-view-date">
            <?= $from ?> - <?= $to ?>
        </div>
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
        
        <div class="transaction-view-footer">
            <div class="transaction-view-footer-item3">
                Saldo Total
            </div>
            <div class="transaction-view-footer-item2">
                <?= $totalSaldo ?>
            </div>
        </div>    
    </div>
    
</div>