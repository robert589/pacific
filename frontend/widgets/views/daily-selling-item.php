<?php
    use common\widgets\Button;
?>

<div id="<?= $id ?>" class="ds-item" data-report-id="<?= $vo->getid() ?>">
    <div id="<?= $id . '-view' ?>" class="ds-item-view">
        <div class="ds-item-field">
            <?= $vo->getRemark() ?>
        </div>
        <div class="ds-item-field">
            <?= $vo->getDebet() ?>
        </div>
        <div class="ds-item-field">
            <?= $vo->getCredit() ?>
        </div>

        <div class="ds-item-field">
            <?= $vo->getSaldoElement() ?>
        </div>
        <div class="ds-item-field ds-item-action">
            <?= Button::widget(['id' => $id . '-remove-btn', 'text' => "<span class='glyphicon glyphicon-remove'></span>",
                        'widgetClass' => 'button-link', 'color' => Button::NONE_COLOR]) ?>
        </div>
    </div>
    <div id="<?= $id . '-remove-area' ?>" 
         class="ds-item-remove app-hide">
        Batalkan hapus <?= Button::widget(['id' => $id . '-cancel', 'text' => "<span class='glyphicon glyphicon-refresh'></span>",
                                        'widgetClass' => 'button-link', 'color' => Button::NONE_COLOR]) ?>
    </div>
</div>