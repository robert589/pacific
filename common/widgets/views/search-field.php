<?php
    use common\widgets\InputField;
    use common\widgets\Button;
?>

<div id="<?= $id ?>" class="search-field <?= $newClass ?>" data-index="<?= $index ?>"
     data-url="<?= $url ?>" data-name="<?= $name ?>">
    <div class="search-field-flex">
        <input name="<?= $name ?>" class="search-field-input" autocomplete="off" 
               type="<?= $type ?>" placeholder="<?= $placeholder ?>" value="<?= $value ?>"
               <?= ($disabled) ? 'disabled' : '' ?>>    
        <?= Button::widget(['id' => $id . '-reset', 'text' => '<span class="glyphicon glyphicon-remove"></span>',
                            'newClass' => 'button-link search-field-reset',
                            'color' => Button::NONE_COLOR]) ?>
    </div>
    <div class='search-field-loading app-hide'>
        Retrieving Data ... 
    </div>
    <div class="search-field-dropdown app-hide">
        
    </div>
    <div class="field-error app-hide">
        
    </div>
</div>
