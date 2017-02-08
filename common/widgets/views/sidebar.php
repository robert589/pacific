<?php
    use common\widgets\SidebarItem;
?>

<div id="<?= $id ?>" class="sidebar">
    <?php foreach($vos as $vo) { ?>
        <?= SidebarItem::widget(['id' => $id . '-' . $vo->getCodeName(), 'vo' => $vo]) ?>
    <?php } ?>
</div>
