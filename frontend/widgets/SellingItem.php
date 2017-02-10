<?php

namespace frontend\widgets;

use yii\base\Widget;

class SellingItem extends Widget {
    
    public $id;
    
    public $vo;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('selling-item',
                ['id' => $this->id, 'vo' => $this->vo]);
    }
}
