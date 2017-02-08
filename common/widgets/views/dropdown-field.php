<?php
    use common\widgets\InputField;
?>

<div id="<?= $id ?>" class="dropdown-field <?= $newClass ?>" data-value="<?= $value ?>"
     data-name="<?= $name ?>" data-text="<?= $text ?>" data-index="<?= $index ?>" 
     <?= $options ?> >
    <div class="dropdown-field-input">
        <div class="dropdown-field-text app-hide">
            
        </div>
        <div class="dropdown-field-placeholder">
            <?= $placeholder ?>
        </div>
        <span class="glyphicon glyphicon-arrow-down dropdown-field-down">
        </span>
        <span class="glyphicon glyphicon-arrow-up app-hide dropdown-field-up">
        </span>
    </div>
    <div class="dropdown-field-dropdown app-hide">
        <?php foreach($items as $index => $text) { ?>
            <div class="dropdown-field-item" data-index="<?= $index ?>"><?= $text ?></div>
        <?php } ?>
    </div>
    
    <div class="field-error app-hide">
            
    </div>
    <?= InputField::widget(['id' => $id . '-input', 'type' => InputField::HIDDEN]) ?>
</div>