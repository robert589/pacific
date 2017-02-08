<?php
?>

<div id="<?= $id ?>" class="text-area-field" data-name="<?= $name ?>">
    <div class="text-area-field-edit" rows=<?= $rows ?> placeholder="<?= $placeholder ?>"  contenteditable="true"
          style="min-height: <?= $rows * 42 ?>px"><?= $value ?></div>
    <div class="field-error app-hide">

    </div>
</div>
