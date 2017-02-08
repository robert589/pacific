<?php
    use yii\grid\GridView;
    use common\widgets\Button;
?>
<div id="<?= $id ?>" class=list-owner row main-area">
    <div class="col-md-9 col-sm-9 content-box">
        <div class="full-width-section clearfix">
            <div class="view-header">
                Daftar Pemilik Kapal
                <?= Button::widget(['id' => $id. '-add', 'text' => 'Tambah Pemilik Kapal', 'newClass' => 'view-header-btn']) ?>
            </div>
            <?=  GridView::widget(
                    ['dataProvider' => $provider,
                    'columns' => [
                        'id',
                        'name'
                    ],
                            
                ]) ?>

        </div>
    </div>
    
</div>  


