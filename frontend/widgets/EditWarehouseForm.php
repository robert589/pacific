<?php

namespace frontend\widgets;

use yii\base\Widget;

class EditWarehouseForm extends Widget {
    
    public $id;
    
    public $vo;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('edit-warehouse-form', 
                ['id' => $this->id, 'vo' => $this->vo]);
    }
}
