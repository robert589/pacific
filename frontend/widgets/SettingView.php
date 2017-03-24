<?php

namespace frontend\widgets;

use yii\base\Widget;

class SettingView extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('setting-view', ['id' => $this->id]);
    }
}
