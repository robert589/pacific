<?php
namespace frontend\models;

use common\models\UserEmailAuthentication;
use common\models\User;
use common\components\RModel;
/**
 * ChangePasswordForm model
 *
 */
class ChangePasswordForm extends RModel
{

    //attributes
    public $user_id;

    public $old_password;

    public $new_password;
    
    private $user;
    
    private $userEmail;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', 'checkExist'],
            
            ['old_password', 'string'],
            ['old_password', 'required'],
            ['old_password', 'validatePassword'],
            
            ['new_password', 'required'],
            ['new_password', 'string', 'min' => 6],
            ['new_password', 'isTheSame']
            
        ];
    }
    
    public function isTheSame() {
        if($this->old_password === $this->new_password) {
            $this->addError('new_password', 'Password New and Old are the same');
        }
    }
    
    public function checkExist() {
        $this->user = User::find()->where(['id' => $this->user_id])->one();
        $this->userEmail = UserEmailAuthentication::find()->where(['user_id' => $this->user_id])->one();
        if(!$this->user || !$this->userEmail) {
            $this->addError('user_id', 'User or Email does not exist');
        }
    }
    public function validatePassword() {
        $valid = UserEmailAuthentication::validatePassword($this->userEmail->email, $this->old_password);
        if(!$valid) {
            $this->addError('old_password', 'Password is wrong');
        }
    }
    
    public function change() {
        if(!$this->validate()) {
            return false;
        }
        $this->userEmail->setPassword($this->new_password);
        return $this->userEmail->update();


    }
}