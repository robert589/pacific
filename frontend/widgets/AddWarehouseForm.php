<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddWarehouseForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-warehouse-form', ['id' => $this->id]);
    }
}
