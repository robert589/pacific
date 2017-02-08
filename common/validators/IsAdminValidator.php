<?php

namespace common\validators;
use common\models\Admin;
use yii\validators\Validator;

class IsAdminValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if(!Admin::find()->where(['id' => $model->$attribute])->exists()) {
            $model->addError($model, $attribute, 'You must be an Admin');
        }
    }
}