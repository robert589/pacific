<?php

namespace common\validators;
use common\models\Admin;
use yii\validators\Validator;

class DateValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        $date = $model[$attribute];
        if(!$date) {
            return;
        }
        $dates = explode('/',$date);
        if(count($dates) !== 3) {
            return $model->addError($attribute, "Not a date format");
        }
        list($dd, $mm, $yyyy) = $dates;
        
        if(!($dd && $mm && $yyyy)) {
            return $model->addError($attribute, "Not a date format");
        }
        if (!checkdate($mm,$dd,$yyyy)) {
            return $model->addError($attribute, "Not a date format");
        }
    }
}