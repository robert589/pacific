<?php
    use common\widgets\Modal;
    use common\widgets\Button;
?>

<?php Modal::begin([
    'id' => $id,
    'newClass' => 'emodal',
    'size' => Modal::SIZE_LARGE
]) ?>
    <div class="emodal-content">
    </div>
<?php Modal::end() ?>
