<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * UserVo builder
 *
 */
class UserVoBuilder extends RVoBuilder
{
    function build() { return new UserVo($this);  }
    //attributes

    public $id;
    
    public $email;

    public $firstName;

    public $lastName;

    public $address;

    public $telephone;

    public function rules() { 
        return [
           ['id','string'],
           ['firstName','string'],
           ['lastName','string'],
           ['address','string'],
           ['telephone','string'],
            ['email', 'string']
        ];
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

    //setters

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setFirstName($firstName) { 
        $this->firstName = $firstName; 
    }

    public function setLastName($lastName) { 
        $this->lastName = $lastName; 
    }

    public function setAddress($address) { 
        $this->address = $address; 
    }

    public function setTelephone($telephone) { 
        $this->telephone = $telephone; 
    }
    
    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }


}