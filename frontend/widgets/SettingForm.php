<?php

namespace frontend\widgets;

use yii\base\Widget;

class SettingForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('setting-form', ['id' => $this->id]);
    }
}
