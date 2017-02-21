<?php
namespace frontend\daos;

use Yii;
use common\models\Ship;
use common\components\Dao;
use common\models\ShipOwner;
use frontend\vos\OwnerVo;
use frontend\vos\UserVo;
use frontend\vos\ShipVo;
/**
 * ShipDao class
 */
class ShipDao implements Dao
{
    const GET_ALL_SHIPS = "SELECT *
                            from ship where ship.status = :status";
    
    const SEARCH_SHIPS = "SELECT *
                            from ship
                            where ship.name like :query and ship.status = :status";
    
    
    const SEARCH_SHIPS_BY_OWNER = "SELECT *
                            from ship, ship_owner
                            where ship.name like :query and ship.status = :status
                                and ship.id = ship_owner.ship_id and ship_owner.owner_id = :owner_id";
    
    const GET_SHIP_OWNERSHIP = "select user.first_name as user_first_name, user.last_name as user_last_name,
                                        user.id as user_id
                                from owner, user, ship_owner
                                where ship_owner.ship_id = :ship_id and ship_owner.owner_id = owner.id
                                    and owner.id = user.id and ship_owner.status = :status";
    
    const GET_HIGHEST_CODE = "SELECT max(id) as max_id from entity";
    
    
    public function getHighestCode() {
        $result =  \Yii::$app->db
            ->createCommand(self::GET_HIGHEST_CODE)
            ->queryScalar();
        
        return intval($result);
    }
    
    /**
     * 
     * @param int $shipId
     * @param string $status
     * @return frontend\vos\ShipVo[]
     */
    public function getShipOwnership($shipId, $status = ShipOwner::STATUS_ACTIVE) {
        $results =  \Yii::$app->db
            ->createCommand(self::GET_SHIP_OWNERSHIP)
            ->bindParam(":ship_id", $shipId)
            ->bindParam(":status", $status)
            ->queryAll();
        
        $vos = [];
        
        foreach($results as $result) {
            $builder = OwnerVo::createBuilder();
            
            $userBuilder = UserVo::createBuilder();
            $userBuilder->loadData($result, "user");
            $builder->setUser($userBuilder->build());
            
            $vos[] = $builder->build();
        }
        return $vos;
    
    }
    
    /**
     * 
     * @param string $q
     * @return \frontend\vos\ShipVo[]
     */
    public function searchShips(string $q) {
        $q = '%' . $q . '%';
        $status = Ship::STATUS_ACTIVE;
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_SHIPS)
            ->bindParam(':query', $q)
            ->bindParam(':status', $status)
            ->queryAll();
        $vos = [];
        
        foreach($results as $result) {
            $builder = ShipVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;
    }

    /**
     * 
     * @return \frontend\vos\ShipVo[] get all active ships
     */
    public function getAllShips() {
        $status = Ship::STATUS_ACTIVE;
        $results =  \Yii::$app->db
            ->createCommand(self::GET_ALL_SHIPS)
            ->bindParam(':status', $status)
            ->queryAll();
        
        $vos = [];
        
        foreach($results as $result) {
            $builder = ShipVo::createBuilder();
            $builder->loadData($result);
            $builder->setOwners($this->getShipOwnership($builder->getId()));
            $vos[] = $builder->build();
        }
        return $vos;
    
    }

    public function searchShipsByOwner($q, $ownerId, $status = Ship::STATUS_ACTIVE) {
        $q = '%' . $q . '%';
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_SHIPS_BY_OWNER)
            ->bindParam(':query', $q)
            ->bindParam(':status', $status)
            ->bindParam(':owner_id', $ownerId)
            ->queryAll();
        $vos = [];
        
        foreach($results as $result) {
            $builder = ShipVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;
    }
}

