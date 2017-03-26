<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddAssetFormModal extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-asset-form-modal', ['id' => $this->id]);
    }
}
