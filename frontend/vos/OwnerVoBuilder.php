<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * OwnerVo builder
 *
 */
class OwnerVoBuilder extends RVoBuilder
{
    function build() { return new OwnerVo($this);  }
    //attributes

    public $user;

    public $totalEntities;

    public $entities;

    public function rules() { 
        return [
           ['user','string'],
           ['totalEntities','string'],
           ['entities','string'],
        ];
    }

    //getters

    public function getUser() { 
        return $this->user; 
    }

    public function getTotalEntities() { 
        return $this->totalEntities; 
    }

    public function getEntities() { 
        return $this->entities; 
    }

    //setters

    public function setUser($user) { 
        $this->user = $user; 
    }

    public function setTotalEntities($totalEntities) { 
        $this->totalEntities = $totalEntities; 
    }

    public function setEntities($entities) { 
        $this->entities = $entities; 
    }
}