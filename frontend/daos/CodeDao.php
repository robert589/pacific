<?php
namespace frontend\daos;

use Yii;
use common\components\Dao;
use common\models\EntityType;
use frontend\vos\EntityVo;
use frontend\vos\EntityTypeVo;
/**
 * CodeDao class
 */
class CodeDao implements Dao
{
    
    const GET_CODE_LIST = "SELECT entity.*, entity_type.id as entity_type_id, entity_type.name as entity_type_name 
                            from entity, entity_type
                            where entity.type_id = entity_type.id ";
    
    const GET_CODE_TYPE_LIST = "SELECT *
                                from entity_type";
                                
    const SEARCH_CODE_TYPE = "SELECT entity_type.id, entity_type.name
                            from entity_type
                            where (entity_type.name LIKE :query or entity_type.id LIKE :query) and
                                        entity_type.status = :status";
    
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

