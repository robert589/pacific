<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddRoleToUserFormBtnc extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-role-to-user-form-btnc', ['id' => $this->id]);
    }
}
