<?php
namespace frontend\daos;

use Yii;
use common\models\Entity;
use frontend\vos\EntityVo;
use frontend\vos\WarehouseVo;
use common\components\Dao;
/**
 * InventoryDao class
 */
class InventoryDao implements Dao
{
    const GET_WAREHOUSE_LIST = "select entity.*,    
                                        warehouse.location as warehouse_location, 
                                        warehouse.id as warehouse_id
                                from warehouse, entity
                                where warehouse.id = entity.id";
    
    
    const SEARCH_WAREHOUSE = "select warehouse.location as warehouse_location,
                                    warehouse.id as warehouse_id, 
                                    entity.*
                    from warehouse, entity
                    where entity.name LIKE :query and 
                        warehouse.id = entity.id and
                        entity.status = IFNULL(:entity_status, entity.status)
                    limit 4";
    
    public function searchWarehouse($query, $status = Entity::STATUS_ACTIVE) {
        $results = \Yii::$app->db
            ->createCommand(self::GET_WAREHOUSE_LIST)
            ->bindParam(':query', $query)
            ->bindParam(':entity_status', $status)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $vos[] = $this->buildVoBuilder($result)->build();
        }
        
        return $vos;
    }
    
    public function getWarehouseList() {
        $results = \Yii::$app->db
            ->createCommand(self::GET_WAREHOUSE_LIST)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $vos[] = $this->buildVoBuilder($result)->build();
        }
        
        return $vos;
    }
    
    private function buildVoBuilder($result) {
        $builder = WarehouseVo::createBuilder();
        $builder->loadData($result, "warehouse");

        $entityBuilder = EntityVo::createBuilder();
        $entityBuilder->loadData($result);
        $builder->setEntity($entityBuilder->build());
        return $builder;
    }
}

