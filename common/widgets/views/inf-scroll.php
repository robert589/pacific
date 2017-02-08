<?php
    use common\widgets\Button;
?>
<div id="<?= $id ?>" class="inf-scroll <?= $widget_class ?>"
     data-load-url="<?= $url ?>"
     data-total="<?= $total ?>"
     data-scroll-value="<?= $scrollValue ?>"
     <?= $additionalData ?>>
    <?= $content ?>
    <div class="inf-scroll-new">
        
    </div>
    <?= Button::Widget(['id' => $id . '-loadmore', 
        'text' => 'Load More (' . '<span class="inf-scroll-total"></span>' . ")", 
        'widgetClass' => 'inf-scroll-loadmore']) ?>
    <div class="inf-scroll-reached-end app-hide">
        You reached the end
    </div>
</div>
