<?php
    use common\widgets\Button;
?>

<div id="<?= $id ?>" class="dr-item" data-report-id="<?= $vo->getid() ?>">
    <div id="<?= $id . '-view' ?>" class="dr-item-view">
        <div class="dr-item-field">
            <?= $vo->getRemark() ?>
        </div>
        <div class="hide600 dr-item-field">
            <?= $vo->getDebet() ?>
        </div>
        <div class="hide600 dr-item-field">
            <?= $vo->getCredit() ?>
        </div>

        <div class="dr-item-field">
            <?= $vo->getSaldoElement() ?>
        </div>
        <div class="dr-item-field dr-item-action">
            <?= Button::widget(['id' => $id . '-remove-btn', 'text' => "<span class='glyphicon glyphicon-remove'></span>",
                        'widgetClass' => 'button-link', 'color' => Button::NONE_COLOR]) ?>
        </div>
    </div>
    <div id="<?= $id . '-remove-area' ?>" 
         class="dr-item-remove app-hide">
        Batalkan hapus <?= Button::widget(['id' => $id . '-cancel', 'text' => "<span class='glyphicon glyphicon-refresh'></span>",
                                        'widgetClass' => 'button-link', 'color' => Button::NONE_COLOR]) ?>
    </div>
</div>