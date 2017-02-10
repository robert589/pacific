<?php

namespace frontend\widgets;

use yii\base\Widget;

class CustomSellingForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('custom-selling-form', ['id' => $this->id]);
    }
}
