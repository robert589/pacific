<?php
namespace frontend\models;

use common\models\EntityOwner;
use common\libraries\UserLibrary;
use common\components\RModel;
/**
 * AddEntityRelationForm model
 *
 */
class AddEntityRelationForm extends RModel
{

    //attributes
    public $user_id;

    public $code;

    public $subcode;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', 'checkAC'],
            
            ['code', 'integer'],
            ['code', 'required'],
            
            ['subcode', 'integer'],
            ['subcode', 'required']
            
            
        ];
    }
    
    public function add() {
        if(!$this->validate()) {
            return false;
        }
    }
    
    public function getEntityOwner() {
    }

}