<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use frontend\vos\EntityVo;
use common\components\RVo;
use frontend\vos\UserVo;
/**
 * OwnerVo vo
 *
 */
class OwnerVo implements RVo
{
    public static function createBuilder() { return new OwnerVoBuilder();} 
    //attributes

    /**
     *
     * @var UserVo
     */
    private $user;

    /**
     *
     * @var int
     */
    private $totalEntities;

    /**
     *
     * @var EntityVo[]|null 
     */
    private $entities;

    public function __construct(OwnerVoBuilder $builder) { 
        $this->user = $builder->getUser(); 
        $this->totalEntities = $builder->getTotalEntities(); 
        $this->entities = $builder->getEntities(); 
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
}