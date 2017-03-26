<?php 
    use common\widgets\Modal;
    use frontend\widgets\AddAssetForm;
?>

<?php Modal::begin([
    'id' => $id,
    'title' => 'Tambah Aset',
    'size' => Modal::SIZE_MEDIUM
]) ?>

    <?= AddAssetForm::widget(['id' => $id . '-form']) ?>
<?php Modal::end() ?>