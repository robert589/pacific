<?php

namespace frontend\widgets;

use yii\base\Widget;

class LoginForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('login-form', ['id' => $this->id]);
    }
}
