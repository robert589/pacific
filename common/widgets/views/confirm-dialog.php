<?php
    use common\widgets\Modal;
    use common\widgets\Button;
?>

<?php Modal::begin([
    'id' => $id,
    'newClass' => 'cdialog',
    'size' => Modal::SIZE_LARGE
]) ?>
    <div class="cdialog-text">
    </div>
    <div class="cdialog-footer">
        <?= Button::widget(['id' => $id . '-ok', 'text' => 'Ok', 'newClass' => 'cdialog-ok']) ?>
        
        <?= Button::widget(['id' => $id . '-cancel', 'text' => 'Cancel', 'newClass' => 'cdialog-cancel']) ?>
    </div>


<?php Modal::end() ?>
