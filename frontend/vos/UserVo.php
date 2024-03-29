<?php
namespace frontend\vos;

use common\models\User;
use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * UserVo vo
 *
 */
class UserVo implements RVo
{
    public static function createBuilder() { return new UserVoBuilder();} 
    //attributes

    private $id;

    private $firstName;

    private $lastName;

    private $address;

    private $telephone;
    
    private $email;
    
    private $status;
    
    private $roles;
    
    public function __construct(UserVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->firstName = $builder->getFirstName(); 
        $this->lastName = $builder->getLastName(); 
        $this->address = $builder->getAddress(); 
        $this->telephone = $builder->getTelephone(); 
        $this->email = $builder->getEmail();
        $this->roles = $builder->getRoles();
        $this->status = $builder->getStatus();
    }
    
    public function getEmail() {
        return  $this->email;
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getFirstName() { 
        return $this->firstName; 
    }

    public function getLastName() { 
        return $this->lastName; 
    }

    public function getAddress() { 
        return $this->address; 
    }

    public function getTelephone() { 
        return $this->telephone; 
    }
    
    public function getName() {
        if(!$this->firstName) {
            return null;
        }
        return $this->firstName . ' ' . $this->lastName; 
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function getStatusText() {
        return User::getStatus()[$this->status];
    }

    public function isActive() {
        return intval($this->status) === intval(User::STATUS_ACTIVE);
    }
    
    public function getRoles() {
        return $this->roles;
    }
}