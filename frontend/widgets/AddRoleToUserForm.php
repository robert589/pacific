<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddRoleToUserForm extends Widget {
    
    public $id;
    
    public $userId;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-role-to-user-form', 
                ['id' => $this->id, 'userId' => $this->userId]);
    }
}
