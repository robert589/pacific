<?php
namespace frontend\daos;

use Yii;
use frontend\vos\AssetVo;
use common\models\Entity;
use frontend\vos\EntityVo;
use frontend\vos\WarehouseVo;
use frontend\vos\InventoryVo;
use common\components\Dao;
/**
 * InventoryDao class
 */
class InventoryDao implements Dao
{
    const GET_WAREHOUSE_INFO = "select entity.*,    
                                        warehouse.location as warehouse_location, 
                                        warehouse.id as warehouse_id,
                                        warehouse.selling_place as warehouse_selling_place
                                from warehouse, entity
                                where warehouse.id = entity.id and 
                                    warehouse.id = :warehouse_id and
                                    entity.status = :entity_status";
    
    const GET_WAREHOUSE_LIST = "select entity.*,    
                                        warehouse.location as warehouse_location, 
                                        warehouse.id as warehouse_id,
                                        warehouse.selling_place as warehouse_selling_place
                                from warehouse, entity
                                where warehouse.id = entity.id";
    
    const GET_INVENTORY_LIST = "select entity_warehouse.name as entity_warehouse_name,
                                       asset.id as asset_id,
                                       asset.name as asset_name,
                                       inventory.*
                                from warehouse, entity entity_warehouse, entity asset, inventory
                                where warehouse.id = entity_warehouse.id and
                                    asset.id = inventory.entity_id and 
                                    inventory.warehouse_id = warehouse.id";
    
    const GET_ASSET_LIST = "select entity.*, asset.method as asset_method
                            from asset, entity
                            where asset.id = entity.id and
                                entity.status = IFNULL(:status, entity.status)";
    
    const SEARCH_WAREHOUSE = "select warehouse.location as warehouse_location,
                                    warehouse.id as warehouse_id, 
                                    entity.*
                    from warehouse, entity
                    where entity.name LIKE :query and 
                        warehouse.id = entity.id and
                        entity.status = IFNULL(:entity_status, entity.status)
                    limit 4";
    
    
    const SEARCH_SELLING_WAREHOUSE = "select warehouse.location as warehouse_location,
                                    warehouse.id as warehouse_id, 
                                    entity.*
                    from warehouse, entity
                    where entity.name LIKE :query and 
                        warehouse.id = entity.id and
                        warehouse.selling_place = 1 and
                        entity.status = IFNULL(:entity_status, entity.status)
                    limit 4";   
    /**
     * 
     * @param int $warehouseId
     * @param int $status
     * @return WarehouseVo
     */
    public function getWarehouseInfo($warehouseId, $status = Entity::STATUS_ACTIVE) {
        $result = \Yii::$app->db
            ->createCommand(self::GET_WAREHOUSE_INFO)
            ->bindParam(':warehouse_id', $warehouseId )
            ->bindParam(':entity_status', $status)
            ->queryOne();
        
        if(!$result) {
            return null;
        }
        
        return $this->buildWarehouseVoBuilder($result)->build();
    }
    
    public function getAssetList() {
        $results = \Yii::$app->db
            ->createCommand(self::GET_ASSET_LIST)
            ->bindParam(':status', $status)
            ->queryAll();
        
        $vos = [];
        
        foreach($results  as $result) {
            $vos[] = $this->getAssetBuilder($result)->build();
        }
        return $vos;
        
    }
    
    private function getAssetBuilder($result) {
        $builder = AssetVo::createBuilder();
        $builder->loadData($result, "asset");
        
        $entityBuilder = EntityVo::createBuilder();
        $entityBuilder->loadData($result);
        $builder->setEntity($entityBuilder->build());
        
        return $builder;
    }
    
    public function getInventoryList() {
        $results = \Yii::$app->db
            ->createCommand(self::GET_INVENTORY_LIST)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = InventoryVo::createBuilder();
            $builder->loadData($result);
            
            $entityWarehouseBuilder = EntityVo::createBuilder();
            $entityWarehouseBuilder->loadData($result, "entity_warehouse");
            $warehouseBuilder = WarehouseVo::createBuilder();
            $warehouseBuilder->setEntity($entityWarehouseBuilder->build());
            $builder->setWarehouse($warehouseBuilder->build());

            $assetBuilder = EntityVo::createBuilder();
            $assetBuilder->loadData($result, "asset");
            $builder->setEntity($assetBuilder->build());
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
    
    public function searchSellingWarehouse($query, $status = Entity::STATUS_ACTIVE) {
        $query  = "%" . $query . "%";
        $results = \Yii::$app->db
            ->createCommand(self::SEARCH_SELLING_WAREHOUSE)
            ->bindParam(':query', $query)
            ->bindParam(':entity_status', $status)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $vos[] = $this->buildWarehouseVoBuilder($result)->build();
        }
        
        return $vos;
    }
    
    public function searchWarehouse($query, $status = Entity::STATUS_ACTIVE) {
        $query  = "%" . $query . "%";
        $results = \Yii::$app->db
            ->createCommand(self::SEARCH_WAREHOUSE)
            ->bindParam(':query', $query)
            ->bindParam(':entity_status', $status)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $vos[] = $this->buildWarehouseVoBuilder($result)->build();
        }
        
        return $vos;
    }
    
    public function getWarehouseList() {
        $results = \Yii::$app->db
            ->createCommand(self::GET_WAREHOUSE_LIST)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $vos[] = $this->buildWarehouseVoBuilder($result)->build();
        }
        
        return $vos;
    }
    
    private function buildWarehouseVoBuilder($result) {
        $builder = WarehouseVo::createBuilder();
        $builder->loadData($result, "warehouse");

        $entityBuilder = EntityVo::createBuilder();
        $entityBuilder->loadData($result);
        $builder->setEntity($entityBuilder->build());
        return $builder;
    }
}

