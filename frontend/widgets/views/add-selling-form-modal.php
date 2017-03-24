<?php
    use frontend\widgets\AddSellingForm;
    use common\widgets\Modal;
?>

<?php Modal::begin([
    'id' => $id,
    'title' => 'Tambah Penjualan',
    
]) ?>

    <?= AddSellingForm::widget(['id' => $id . '-form']) ?>
<?php Modal::end() ?>



