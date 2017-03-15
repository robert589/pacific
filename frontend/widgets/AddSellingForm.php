<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddSellingForm extends Widget {
    
    public $id;
    
    public $productId;
    
    public $date;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-selling-form', 
                ['id' => $this->id, 
                'productId' => $this->productId, 
                'date' => $this->date]);
    }
}
