<?php
    use common\widgets\Button;
?>

<div id="<?= $id ?>" class="selling-item" data-selling-id="<?= $vo->getid() ?>">
    <div id="<?= $id . '-view' ?>" class="selling-item-view">
        <div class="selling-item-field">
            <?= $vo->getDate() ?>
        </div>
        <div class="selling-item-field">
            <?= $vo->getBuyer()->getName() ?>
        </div>

        <div class="selling-item-field">
            <?= $vo->getRemark() ?>
        </div>
        <div class="hide600 selling-item-field">
            <?= $vo->getPriceInCurrency() ?>
        </div>
        <div class="hide600 selling-item-field">
            <?= $vo->getTonase() ?>
        </div>

        <div class="selling-item-field">
            <?= $vo->getTotalInCurrency() ?>
        </div>  
    </div>
</div>