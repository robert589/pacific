<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddRoleForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-role-form', ['id' => $this->id]);
    }
}
