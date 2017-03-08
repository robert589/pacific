<?php

namespace frontend\widgets;

use yii\base\Widget;

class AssignRightsToRoleForm extends Widget {
    
    public $id;
    
    public $roleId;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('assign-rights-to-role-form', 
                ['id' => $this->id, 'roleId' => $this->roleId]);
    }
}
