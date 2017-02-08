<?php
    use common\widgets\Modal;
?>

<?php Modal::begin(['id' => $id, 'title' => $title]); ?>
    <img src="<?= $src ?>" class="image-view-modal-img">
<?php Modal::end(); ?>