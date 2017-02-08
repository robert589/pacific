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

    public $totalShips;

    public $ships;

    public function rules() { 
        return [
           ['user','string'],
           ['totalShips','string'],
           ['ships','string'],
        ];
    }

    //getters

    public function getUser() { 
        return $this->user; 
    }

    public function getTotalShips() { 
        return $this->totalShips; 
    }

    public function getShips() { 
        return $this->ships; 
    }

    //setters

    public function setUser($user) { 
        $this->user = $user; 
    }

    public function setTotalShips($totalShips) { 
        $this->totalShips = $totalShips; 
    }

    public function setShips($ships) { 
        $this->ships = $ships; 
    }
}