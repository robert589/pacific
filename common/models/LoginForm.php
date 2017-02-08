<?php
namespace common\models;

use Yii;
use common\components\RModel;
use common\models\UserEmailAuthentication;
/**
 * Login form
 */
class LoginForm extends RModel
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user;

    
        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                // username and password are both required
                [['email', 'password'], 'required'],
                // rememberMe must be a boolean value
                ['rememberMe', 'boolean'],
                // password is validated by validatePassword()
                ['password', 'validatePassword'],
            ];
        }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $userEmail = $this->getUserEmail();
            if (!$userEmail || !$userEmail->validatePassword($this->email, $this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate() && ($user = $this->getUser($this->getId()))) {
            return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /** 
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser($id)
    {
        if ($this->_user === null) {
            $this->_user = User::find()->where(['id' => $id, 'status' => User::STATUS_ACTIVE])->one();
        }
        return $this->_user;
    }
    
    protected function getUserEmail() {
        return UserEmailAuthentication::find()->where(['email' => $this->email])->one();
    }
    
    protected function getId() {
        return UserEmailAuthentication::find()->where(['email' => $this->email])->one()['user_id'];
    }
}
