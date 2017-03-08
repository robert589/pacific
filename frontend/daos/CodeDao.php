<?php
namespace frontend\daos;

use Yii;
use common\models\Entity;
use common\components\Dao;
use common\models\EntityType;
use frontend\vos\EntityVo;
use frontend\vos\EntityTypeVo;
/**
 * Code and Entity are actually the same
 * CodeDao class
 */
class CodeDao implements Dao
{
    
    const GET_CODE_LIST = "SELECT entity.*, entity_type.id as entity_type_id, entity_type.name as entity_type_name 
                            from entity, entity_type
                            where entity.type_id = entity_type.id ";
    
    const GET_SUB_CODE = "SELECT entity.*, entity_type.id as entity_type_id, entity_type.name as entity_type_name
                        from entity_relation, entity, entity_type
                        where entity_relation.parent_entity_id = :entity_id and
                            entity_relation.child_entity_id = entity.id and 
                            entity_type.id = entity.type_id and entity_relation.status = :status
                            order by entity.code asc"
            ;
    const GET_CODE_TYPE_LIST = "SELECT *
                                from entity_type";
                                
    const SEARCH_CODE_TYPE = "SELECT entity_type.id, entity_type.name
                            from entity_type
                            where (entity_type.name LIKE :query or entity_type.id LIKE :query) and
                                        entity_type.status = :status    
                            limit 4";

    const SEARCH_CODE = "SELECT entity.id, entity.name, entity.code
                            from entity
                            where (entity.name LIKE :query or entity.code LIKE :query) and
                                        entity.status = :status
                            limit 4";
    
    const SEARCH_CODE_BY_OWNER = "select entity.*
                                from entity, entity_owner
                                where (entity.name LIKE :query or entity.code LIKE :query) and
                                    entity.status = :status and
                                    entity.id = entity_owner.entity_id and
                                    entity_owner.owner_id = :user_id
                                    limit 4";
    public function getSubcode($entityId, $status = Entity::STATUS_ACTIVE) {
        
        $results = \Yii::$app->db
            ->createCommand(self::GET_SUB_CODE)
            ->bindParam(':status', $status)
            ->bindParam(':entity_id', $entityId)
            ->queryAll();
        $vos = [];
        
        foreach($results as $result) {
            $builder = EntityVo::createBuilder();
            $builder->loadData($result);
            $typeBuilder = EntityTypeVo::createBuilder();
            $typeBuilder->loadData($result, "entity_type");
            $builder->setEntityType($typeBuilder->build());
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
    
    public function searchCode($query, $status = Entity::STATUS_ACTIVE) {
        $q = '%' . $query . '%';
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_CODE)
            ->bindParam(':query', $q)
            ->bindParam(':status', $status)
            ->queryAll();
        $vos = [];
        
        foreach($results as $result) {
            $builder = EntityVo::createBuilder();
            
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;    
    
    }
    
    public function searchCodeByOwner($query, $userId, $status = Entity::STATUS_ACTIVE) {
        $q = '%' . $query . '%';
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_CODE_BY_OWNER)
            ->bindParam(':query', $q)
            ->bindParam(':user_id', $userId)
            ->bindParam(':status', $status)
            ->queryAll();
        $vos = [];
        
        foreach($results as $result) {
            $builder = EntityVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;    
    
    }
    
    public function searchCodeType($query, $status = EntityType::STATUS_ACTIVE) {
        $q = '%' . $query . '%';
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_CODE_TYPE)
            ->bindParam(':query', $q)
            ->bindParam(':status', $status)
            ->queryAll();
        $vos = [];
        
        foreach($results as $result) {
            $builder = EntityTypeVo::createBuilder();
            
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;    
    }
    
    public function getCodeTypeList() {
        $results = \Yii::$app->db
            ->createCommand(self::GET_CODE_TYPE_LIST)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = EntityTypeVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;

    }

    public function getCodeList() {
        $results = \Yii::$app->db
            ->createCommand(self::GET_CODE_LIST)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = EntityVo::createBuilder();
            $builder->loadData($result);
            $typeBuilder = EntityTypeVo::createBuilder();
            $builder->setEntityType($typeBuilder->build());
            $vos[] = $builder->build();
        }
        
        return $vos;

    }
            
}

