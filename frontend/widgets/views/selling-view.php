<?php
    use frontend\widgets\SellingItem;
?>

<div id="<?= $id ?>" class="selling-view">
    <div class="selling-view-area">
        <div class="selling-view-header">
            
            <div class="selling-view-header-field">
                Tanggal
            </div>
            <div class="selling-view-header-field">
                Keterangan
            </div>
            <div class="selling-view-header-field">
                Harga
            </div>
            <div class="selling-view-header-field">
                Tonase
            </div>
            <div class="selling-view-header-field">
                Total
            </div>
        </div>
        <?php foreach($vos as $vo ) { ?>
            <?= SellingItem::widget(['id' => $id . '-' . $vo->getId(), 'vo' => $vo]) ?>
        <?php } ?>
    </div>
    <div class="selling-view-footer">
        <div class="selling-view-footer-item3">
            Penjualan Total
        </div>
        <div class="selling-view-footer-item2">
            <?= $dailySaldo ?>
        </div>
    </div>    
    <div class="selling-view-footer">
        <div class="selling-view-footer-item3">
            Penjualan saat ini
        </div>
        <div class="selling-view-footer-item2">
            <?= $currentSaldo ?>
        </div>
    </div>
    
</div>