<?php
    use common\widgets\InputField;
    use common\widgets\SearchField;
    use common\widgets\Button;
    use frontend\widgets\CustomReportForm;
?>

<div id="<?= $id ?>" class="custom-report view">
    <div class="view-header">
        Laporan Random
    </div>
    
    <?= CustomReportForm::widget(['id' => $id . '-form']) ?>
    
    <div class="custom-report-area">
        
    </div>
</div>