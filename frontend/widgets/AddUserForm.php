<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddUserForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-user-form', ['id' => $this->id]);
    }
}
