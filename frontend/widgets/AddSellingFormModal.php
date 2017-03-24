<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddSellingFormModal extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-selling-form-modal', ['id' => $this->id]);
    }
}
