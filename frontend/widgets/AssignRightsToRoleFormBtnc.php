<?php

namespace frontend\widgets;

use yii\base\Widget;

class AssignRightsToRoleFormBtnc extends Widget {
    
    public $id;
    
    public $roleId;
    
    public $newClass;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('assign-rights-to-role-form-btnc', 
                ['id' => $this->id, 'roleId' => $this->roleId,
                    'newClass' => $this->newClass]);
    }
}
