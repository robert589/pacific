<?php
    use common\widgets\Button;
?>

<div id="<?= $id ?>" class="dynamic-field <?= $newClass ?>" data-name="<?= $name ?>">
    <div class="dynamic-field-init"><?= $content ?></div>
    <div class="dynamic-field-area">
        
    </div>
    
    <?= Button::widget(['id' => $id . '-add', 
        'text' => '<span class="glyphicon glyphicon-plus"></span>', 
        'widgetClass' => 'dynamic-field-add']) ?>
    <?= Button::widget(['id' => $id . '-remove', 
        'text' => '<span class="glyphicon glyphicon-remove"></span>', 
        'widgetClass' => 'dynamic-field-remove']) ?>

</div>