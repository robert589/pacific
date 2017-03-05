<?php
    use common\widgets\InputField;
?>


<div id="<?= $id ?>" class="upload-field" 
     data-url="<?= $url ?>"
     data-name="<?= $name ?>">
    <?=    InputField::widget(['id' => $id . '-file', 'type' => InputField::FIlE]) ?>
    
    <div class="field-error app-hide">
    </div>
</div>
