<?php
    use common\widgets\Form;
    use common\widgets\Button;
?>
<form id="<?= $id ?>" method="<?= $method ?>" 
      action="<?= $url ?>"
      url="<?= $url ?>" class="<?= $widget_class ?>" data-file="<?= $file ?>">
    <?= $content ?>
    <?php if($enable_button) { ?>
        <?= Button::widget(['id' => $id . '-submit-btn' , 'text' => $button_text]) ?>
    <?php } ?>
</form>

