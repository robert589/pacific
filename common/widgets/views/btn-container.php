<?php
  use common\widgets\Button;
?>

<div class="btnc" id="<?= $id ?>">
    <?= Button::widget(['id' => $id . '-btn', 
                        'text' => $btnText]) ?>
    
    <div class="btnc-area">
        <?= $content ?>
    </div>
</div>