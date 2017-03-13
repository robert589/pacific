<?php
    use common\widgets\Button;
?>

<div id="<?= $id ?>" class="transaction-item" data-transaction-id="<?= $vo->getid() ?>">
    <div id="<?= $id . '-view' ?>" class="transaction-item-view">
        <div class="transaction-item-field">
            <?= $vo->getDate() ?>
        </div>
        <div class="transaction-item-field">
            <?= $vo->getEntity()->getName() ?>
        </div>
        <div class="transaction-item-field">
            <?= $vo->getRemark() ?>
        </div>
        <div class="transaction-item-field hide600">
            <?= $vo->getDebetView() ?>
        </div>
        <div class="transaction-item-field hide600">
            <?= $vo->getCreditView() ?>
        </div>

        <div class="transaction-item-field">
            <?= $vo->getSaldoElement() ?>
        </div>  
    </div>
    <div id="<?= $id . '-remove-area' ?>" 
         class="transaction-item-remove app-hide">
        Batalkan hapus <?= Button::widget(['id' => $id . '-cancel', 'text' => "<span class='glyphicon glyphicon-refresh'></span>",
                                        'widgetClass' => 'button-link', 'color' => Button::NONE_COLOR]) ?>
    </div>
</div>