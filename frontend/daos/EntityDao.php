<?php
namespace frontend\daos;

use Yii;
use frontend\vos\EntityVo;
use common\models\Entity;
use frontend\vos\OwnerVo;
use frontend\vos\UserVo;
use common\components\Dao;
/**
 * EntityDao class
 */
class EntityDao implements Dao
{
    
    const GET_ALL_ENTITIES_BY_TYPE = "SELECT entity.*
                                        FROM entity, entity_type
                                        where entity.type_id = entity_type.id = entity.type_id = :type_id";
    
    const SEARCH_ENTITIES_BY_TYPE = "SELECT entity.*
                                    from entity, entity_type
                                    where entity.name like :query and 
                                            entity.type_id = entity_type.id and
                                            entity.type_id = :type_id and
                                            entity.status = :status ";
    
    const SEARCH_ENTITIES_BY_TYPE_AND_OWNER  = "SELECT entity.*
                                                from entity, entity_type, entity_owner
                                                where entity.name like :query and 
                                                    entity.type_id = entity_type.id and
                                                    entity.type_id = :type_id and
                                                    entity.status = :status and
                                                    entity.id  = entity_owner.entity_id and
                                                    entity_owner.owner_id = :owner_id";
    
    const GET_ENTITY_OWNERSHIP = "select user.first_name as user_first_name, user.last_name as user_last_name,
                                        user.id as user_id
                                from user, entity_owner
                                where entity_owner.entity_id = :entity_id and 
                                      entity_owner.status = :status and
                                      user.id = entity_owner.owner_id";
    
    public function getEntityOwnership($entityId, $status = Entity::STATUS_ACTIVE) {
        $results =  \Yii::$app->db
            ->createCommand(self::GET_ENTITY_OWNERSHIP)
            ->bindParam(":entity_id", $entityId)
            ->bindParam(':status', $status)
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
     * @param string $query
     * @param int $typeId
     * @param int $status
     * @return EntityVo[]
     */
    public function searchEntitiesByType($query, $typeId, $status = Entity::STATUS_ACTIVE) {
        $query = "%" . $query . "%";
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_ENTITIES_BY_TYPE)
            ->bindParam(":type_id", $typeId)
            ->bindParam(':status', $status)
            ->bindParam(':query', $query)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = EntityVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
    
    /**
     * 
     * @param string $query
     * @param int $userId
     * @param int $typeId
     * @param int $status
     * @return EntityVo[]|array
     */
    public function searchEntitiesByOwnerAndType($query, $userId, $typeId, $status = Entity::STATUS_ACTIVE) {
        $query = "%" . $query . "%";
        $results =  \Yii::$app->db
             ->createCommand(self::SEARCH_ENTITIES_BY_TYPE)
             ->bindParam(":type_id", $typeId)
             ->bindParam(':status', $status)
             ->bindParam(':query', $query)
             ->bindParam(':owner_id', $userId)
             ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = EntityVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
    
    /**
     * 
     * @param int $typeId
     * @return EntityVo[]
     */
    public function getAllEntitiesByType($typeId) {
        $results =  \Yii::$app->db
            ->createCommand(self::GET_ALL_ENTITIES_BY_TYPE)
            ->bindParam(":type_id", $typeId)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = EntityVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;
        
    }
    
}

