<?php
  use common\widgets\Button;
?>

<div class="modal modal-hide <?= $size ?>" id="<?= $id ?>" data-id="<?= $id ?>">
    <div class="modal-close-button">
        <?= Button::widget(['id' => $id . '-close-button', 
                            'text' => '<span aria-hidden="true">&times;</span>', 
                            'color' => Button::NONE_COLOR]) ?>
    </div>
    <div class="modal-content">
        <div class="modal-header">
          <div class="modal-title"><?= $title ?> </div>
        </div>
        <div class="modal-body">
            <?= $content ?>
        </div>
    </div>
</div>