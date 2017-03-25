<?php

namespace frontend\validators;
use frontend\daos\EntityDao;
use common\models\Entity;
use yii\validators\Validator;

class InInventoryValidator extends Validator
{   
    public function validateAttribute($model, $attribute)
    {   
        if(!Entity::inInventory($model->$attribute)) {
            $model->addError($attribute, 'Not in inventory type');
        }
        
    }
}