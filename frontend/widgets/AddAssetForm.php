<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddAssetForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-asset-form', ['id' => $this->id]);
    }
}
