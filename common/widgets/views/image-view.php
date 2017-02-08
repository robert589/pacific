<?php
    use common\widgets\Modal;
    use common\widgets\ImageViewModal;
?>

<div id="<?= $id ?>" class="image-view">
    <img src="<?= $src ?>" class="image-view-img">
    <?=    ImageViewModal::widget(['id' => $id . 'modal', 'title' => $title, 'src' => $src]) ?>
</div>