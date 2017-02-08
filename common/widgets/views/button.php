<?php

?>

<button id="<?= $id ?>" class="<?= $class ?>" <?= $optionText ?> 
        <?= ($disabled) ? 'disabled' : '' ?>>
    <?php if($iconClass !== '') { ?>
        <div class="<?= $iconClass ?>"></div>
    <?php } ?>
        <?= $text ?>
</button>