<div id="<?= $id ?>" class="tab-container" data-active-index="<?= $activeIndex ?>">
    <div class="tab-container-header">
        <?php foreach($tabItems as $index => $item) { ?>
            <span class="tab-container-header-item active" data-index="<?= $index ?>">
                <?= $item ?>
            </span>

        <?php } ?>
    </div>
    <div class="tab-container-body">
        <?= $content ?>
    </div>
</div>