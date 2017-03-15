<?php

namespace frontend\widgets;

use yii\base\Widget;

class ViewDashItem extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('view-dash-item', ['id' => $this->id]);
    }
}
