<?php
namespace common\validators;
use yii\validators\Validator;
use frontend\daos\UserDao;

class AccessValidator extends Validator
{
    public $access;
    
    private $userDao;
    
    public function init() {
        $this->userDao = new UserDao();
    }
    
    
    public function validateAttribute($model, $attribute)
    {
        $has = $this->userDao->hasRight($this->access, $model->$attribute);
        if(!$has) {
            $this->addError($model, $attribute, "You do not have the permission to do so");
        }
    }
}