<?php

namespace frontend\widgets;

use yii\base\Widget;

class OwnershipGridview extends Widget {
    
    public $id;

    public $provider;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('ownership-gridview', ['id' => $this->id, 'provider' => $this->provider]);
    }
}
