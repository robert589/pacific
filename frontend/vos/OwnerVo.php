<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * OwnerVo vo
 *
 */
class OwnerVo implements RVo
{
    public static function createBuilder() { return new OwnerVoBuilder();} 
    //attributes

    private $user;

    private $totalShips;

    private $ships;

    public function __construct(OwnerVoBuilder $builder) { 
        $this->user = $builder->getUser(); 
        $this->totalShips = $builder->getTotalShips(); 
        $this->ships = $builder->getShips(); 
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
}