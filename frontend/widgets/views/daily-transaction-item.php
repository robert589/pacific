<?php
    use common\widgets\Button;
?>

<div id="<?= $id ?>" class="dt-item" data-transaction-id="<?= $vo->getid() ?>">
    <div id="<?= $id . '-view' ?>" class="dt-item-view">
        <div class="dt-item-field">
            <?= $vo->getEntity()->getName() ?>
        </div>
        <div class="hide600 dt-item-field">
            <?= $vo->getDebet() ?>
        </div>
        <div class="hide600 dt-item-field">
            <?= $vo->getCredit() ?>
        </div>

        <div class="dt-item-field">
            <?= $vo->getSaldoElement() ?>
        </div>
        <div class="dt-item-field">
            <?= $vo->getRemark() ?>
        </div>
        <div class="dt-item-field dt-item-action">
            <?= Button::widget(['id' => $id . '-remove-btn', 'text' => "<span class='glyphicon glyphicon-remove'></span>",
                        'widgetClass' => 'button-link', 'color' => Button::NONE_COLOR]) ?>
        </div>
    </div>
    <div id="<?= $id . '-remove-area' ?>" 
         class="dt-item-remove app-hide">
        Batalkan hapus <?= Button::widget(['id' => $id . '-cancel', 'text' => "<span class='glyphicon glyphicon-refresh'></span>",
                                        'widgetClass' => 'button-link', 'color' => Button::NONE_COLOR]) ?>
    </div>
</div>