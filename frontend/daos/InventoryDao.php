<?php
namespace frontend\daos;

use Yii;
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
    
    public function getWarehouseList() {
        $results = \Yii::$app->db
            ->createCommand(self::GET_WAREHOUSE_LIST)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = WarehouseVo::createBuilder();
            $builder->loadData($result, "warehouse");
            
            $entityBuilder = EntityVo::createBuilder();
            $entityBuilder->loadData($result);
            $builder->setEntity($entityBuilder->build());
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
}

