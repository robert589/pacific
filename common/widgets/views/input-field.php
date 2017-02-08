<?php
    use yii\helpers\Html;
?>
<div id="<?= $id ?>" class="input-field <?= $newClass ?>" data-name="<?= $name ?>" 
     <?php if($datepicker) { ?> data-datepicker="<?= $datepicker ?>" <?php } ?>
     <?php if($timepicker) { ?> data-timepicker="<?= $timepicker ?>" <?php } ?>
     data-type="<?= $type ?>"
     >
    <input name="<?= $name ?>" class="input-field-input"
           type="<?= $type ?>" 
           value="<?= $value ?>"
           <?= ($min) ? "min='$min'" : '' ?>
            <?= ($max) ? "max='$max'" : '' ?>
           placeholder="<?= $placeholder ?>" <?= ($disabled) ? 'disabled' : '' ?>>   
    
    <div class="field-error app-hide">     
    </div> 
</div>
