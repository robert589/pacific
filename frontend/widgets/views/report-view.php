<?php
    use frontend\widgets\AddReportForm;
    use frontend\widgets\ReportItem;
?>

<div id="<?= $id ?>" class="report-view">
    <div class="report-view-area">
        <div class="report-view-header">
            <div class="report-view-header-field">
                Tanggal
            </div>
            <div class="report-view-header-field">
                Keterangan
            </div>
            <div class="hide600 report-view-header-field">
                Debet
            </div>
            <div class="hide600 report-view-header-field">
                Kredit
            </div>
            <div class="report-view-header-field">
                Saldo
            </div>
        </div>
        <?php foreach($vos as $vo ) { ?>
            <?= ReportItem::widget(['id' => $id . '-' . $vo->getId(), 'vo' => $vo]) ?>
        <?php } ?>
    </div>
    <div class="report-view-footer">
        <div class="report-view-footer-item3">
            Saldo Total
        </div>
        <div class="report-view-footer-item2">
            <?= $dailySaldo ?>
        </div>
    </div>    
    <div class="report-view-footer">
        <div class="report-view-footer-item3">
            Saldo saat ini
        </div>
        <div class="report-view-footer-item2">
            <?= $currentSaldo ?>
        </div>
    </div>
    
</div>