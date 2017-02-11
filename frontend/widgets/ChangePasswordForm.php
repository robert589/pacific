<?php

namespace frontend\widgets;

use yii\base\Widget;

class ChangePasswordForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('change-password-form', ['id' => $this->id]);
    }
}
