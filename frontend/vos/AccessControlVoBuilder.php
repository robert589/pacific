<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * AccessControlVo builder
 *
 */
class AccessControlVoBuilder extends RVoBuilder
{
    function build() { return new AccessControlVo($this);  }
    //attributes

    public $id;

    public $code;

    public $name;

    public $description;

    public $status;

    public $createdAt;

    public $updatedAt;

    public function rules() { 
        return [
           ['id','string'],
           ['code','string'],
           ['name','string'],
           ['description','string'],
           ['status','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
        ];
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getCode() { 
        return $this->code; 
    }

    public function getName() { 
        return $this->name; 
    }

    public function getDescription() { 
        return $this->description; 
    }

    public function getStatus() { 
        return $this->status; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }

    //setters

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setCode($code) { 
        $this->code = $code; 
    }

    public function setName($name) { 
        $this->name = $name; 
    }

    public function setDescription($description) { 
        $this->description = $description; 
    }

    public function setStatus($status) { 
        $this->status = $status; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }
}