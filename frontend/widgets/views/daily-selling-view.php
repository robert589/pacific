<?php
    use frontend\widgets\AddSellingForm;
    use frontend\widgets\DailySellingItem;
?>

<div id="<?= $id ?>" class="ds-view">
    <div class="ds-view-area">
        <div class="ds-view-header">
            <div class="ds-view-header-field">
                Keterangan
            </div>
            <div class="ds-view-header-field">
                Harga
            </div>
            <div class="ds-view-header-field">
                Tonase
            </div>
            <div class="ds-view-header-field">
                Total
            </div>
            <div class="ds-view-header-field">
                Aksi
            </div>
        </div>
        <?php foreach($vos as $vo ) { ?>
            <?= DailySellingItem::widget(['id' => $id . '-' . $vo->getId(), 'vo' => $vo]) ?>
        <?php } ?>
    </div>
    <div class="ds-view-footer">
        <div class="ds-view-footer-item3">
            Saldo Harian
        </div>
        <div class="ds-view-footer-item2">
            <?= $dailySaldo ?>
        </div>
    </div>
    
    <?=    AddSellingForm::widget(['id' => $id . '-asform',
        'date' => $date, 'shipId' => $shipId]) ?>  
</div>