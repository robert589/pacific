<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * ShipVo builder
 *
 */
class ShipVoBuilder extends RVoBuilder
{
    function build() { return new ShipVo($this);  }
    //attributes

    public $id;

    public $name;

    public $description;

    public $owners;

    public function rules() { 
        return [
           ['id','string'],
           ['name','string'],
           ['description','string'],
           ['owners','string'],
        ];
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getName() { 
        return $this->name; 
    }

    public function getDescription() { 
        return $this->description; 
    }

    public function getOwners() { 
        return $this->owners; 
    }

    //setters

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setName($name) { 
        $this->name = $name; 
    }

    public function setDescription($description) { 
        $this->description = $description; 
    }

    public function setOwners($owners) { 
        $this->owners = $owners; 
    }
}