<?php
namespace frontend\models;

use common\models\Owner;
use common\validators\IsAdminValidator;
use common\components\RModel;
/**
 * CreateOwnerForm model
 *
 */
class CreateOwnerForm extends RModel
{
    //attributes
    public $user_id;

    public $first_name;

    public $last_name;

    public $email;

    public $password;

    public $telephone;

    public $address;

    public function rules() {
        return [
            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', IsAdminValidator::className()],
            
            ['first_name', 'required'],
            ['first_name', 'string'],
            
            ['last_name', 'string'],
            
            ['telephone', 'string'],
            ['address', 'string'],
            
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\UserEmailAuthentication', 'message' => 'This email address has already been taken.'],

            ['password', 'string'],
            ['password', 'required']
        ];
    }
    
    public function create() {
        if(!$this->validate()) {
            return false;
        }
        $model = new SignupForm();
        $model->first_name = $this->first_name;
        $model->last_name = $this->last_name;
        $model->phone = $this->telephone;
        $model->address = $this->address;
        $model->email = $this->email;
        $model->password = $this->password;
        $user = $model->signup();
        if(!$user) {
            return false;
        }
        
        $reseller = new Owner();
        $reseller->id = $user->id;
        return $reseller->save();
    }


    
}