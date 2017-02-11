<?php
    use frontend\widgets\AddReportForm;
    use frontend\widgets\DailyReportItem;
?>

<div id="<?= $id ?>" class="dr-view">
    <div class="dr-view-area">
        <div class="dr-view-header">
            <div class="dr-view-header-field">
                Keterangan
            </div>
            <div class="hide600 dr-view-header-field">
                Debet
            </div>
            <div class="hide600 dr-view-header-field">
                Kredit
            </div>
            <div class="dr-view-header-field">
                Saldo
            </div>
            <div class="dr-view-header-field">
                Aksi
            </div>
        </div>
        <?php foreach($vos as $vo ) { ?>
            <?= DailyReportItem::widget(['id' => $id . '-' . $vo->getId(), 'vo' => $vo]) ?>
        <?php } ?>
    </div>
    <div class="dr-view-footer">
        <div class="dr-view-footer-item3">
            Saldo Harian
        </div>
        <div class="dr-view-footer-item2">
            <?= $dailySaldo ?>
        </div>
    </div>
    <div class="dr-view-footer">
        <div class="dr-view-footer-item3">
            Saldo Sebelumnya
        </div>
        <div class="dr-view-footer-item2">
            <?= $previousSaldo ?>
        </div>
    </div>
    <div class="dr-view-footer">
        <div class="dr-view-footer-item3">
            Saldo sampai tanggal ini
        </div>
        <div class="dr-view-footer-item2">
            <?= $saldoAtPoint ?>
        </div>
    </div>
    
    <div class="dr-view-footer">
        <div class="dr-view-footer-item3">
            Saldo saat ini
        </div>
        <div class="dr-view-footer-item2">
            <?= $currentSaldo ?>
        </div>
    </div>
    
    <?=    AddReportForm::widget(['id' => $id . '-arform',
        'date' => $date, 'shipId' => $shipId]) ?>  
</div>