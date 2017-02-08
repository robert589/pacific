<?php
    use common\widgets\Button;
?>

<div id="<?= $id ?>" class="report-item" data-report-id="<?= $vo->getid() ?>">
    <div id="<?= $id . '-view' ?>" class="report-item-view">
        <div class="report-item-field">
            <?= $vo->getDate() ?>
        </div>
        <div class="report-item-field">
            <?= $vo->getRemark() ?>
        </div>
        <div class="report-item-field">
            <?= $vo->getDebet() ?>
        </div>
        <div class="report-item-field">
            <?= $vo->getCredit() ?>
        </div>

        <div class="report-item-field">
            <?= $vo->getSaldoElement() ?>
        </div>  
    </div>
    <div id="<?= $id . '-remove-area' ?>" 
         class="report-item-remove app-hide">
        Batalkan hapus <?= Button::widget(['id' => $id . '-cancel', 'text' => "<span class='glyphicon glyphicon-refresh'></span>",
                                        'widgetClass' => 'button-link', 'color' => Button::NONE_COLOR]) ?>
    </div>
</div>