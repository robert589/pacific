<?php
  use common\widgets\Button;
?>

<div class="btnc <?= $newClass ?>" id="<?= $id ?>">
    <?= Button::widget(['id' => $id . '-btn', 
                        'text' => $btnText,
                        'color' => $color,
                        'newClass' => $btnNewClass]) ?>
    
    <div class="btnc-area app-hide">
        <?= $content ?>
    </div>
</div>