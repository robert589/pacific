<?php   
               
?>

<div id="<?= $id ?>" class="radio-field" data-name="<?= $name ?>">
    <?php foreach($items as $index => $item) { ?>
        <input type="radio" class="radio-field-item" 
               name="<?= $name ?>" value="<?= $index ?>"
                   
               <?php if($value == $index ) 
                   {
                   echo 'checked';
                   } 
                ?> ><?= $item ?>
    <?php } ?>
    <div class="field-error app-hide">
        
    </div>
</div>
