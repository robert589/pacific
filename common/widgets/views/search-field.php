<?php

?>

<div id="<?= $id ?>" class="search-field <?= $newClass ?>" data-index="<?= $index ?>"
     data-url="<?= $url ?>" data-name="<?= $name ?>">
    <input name="<?= $name ?>" class="search-field-input" autocomplete="off" 
           type="<?= $type ?>" placeholder="<?= $placeholder ?>" value="<?= $value ?>"
           <?= ($disabled) ? 'disabled' : '' ?>>    
    <div class='search-field-loading app-hide'>
        Retrieving Data ... 
    </div>
    <div class="search-field-dropdown app-hide">
        
    </div>
    <div class="field-error app-hide">
        
    </div>
</div>
