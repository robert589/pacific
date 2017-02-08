<?php
    use common\widgets\SearchField;
    use common\widgets\InputField;
    use common\widgets\Button;
?>
<div id="<?= $id ?>" class="daily-report view">
    <div class="view-header">
        Laporan Harian
    </div>
    
    <div class="daily-report-header">
        <?= SearchField::widget(['id' => $id . '-ship', 
                                'url' => \Yii::$app->request->baseUrl . '/ship/search',
                                'placeholder' => 'Cari Kapal',
                                'name' => 'ship_id']) ?>
        
        <?= InputField::widget(['id' => $id . '-date',
                                'datepicker' => true, 'disabled' => true,
                                'type' => 'text',
                                'name' => 'date', 'placeholder' => 'Tanggal']) ?>
        
        <?= Button::widget(['id' => $id . '-refresh', 'disabled' => true,
                            'text' => 'Refresh', 'newClass' => 'daily-report-refresh']) ?>
    </div>
    
    <div class="daily-report-area">
            
    </div>
</div>