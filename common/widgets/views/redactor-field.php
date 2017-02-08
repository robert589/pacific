<?php
    use yii\helpers\Html;
    use yii\redactor\widgets\Redactor;
?>
<div id="<?= $id ?>" class="redactor-field <?= $newClass ?>" data-name="<?= $name ?>" >
    <?= Redactor::widget([
            'id' => $id . '-input',
            'clientOptions' => [
                'plugins' => ['clips', 'fontcolor','imagemanager']
            ]
    ]) ?>   
    
    <div class="field-error app-hide">     
    </div> 
</div>
