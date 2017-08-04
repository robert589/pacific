<?php
namespace frontend\services;

use frontend\daos\EntityDao;
use yii\data\ArrayDataProvider;
use frontend\daos\InventoryDao;
use frontend\validators\InInventoryValidator;
use common\components\RService;
/**
 * InventoryService service
 *
 */
class InventoryService extends RService
{
    
    const GET_WAREHOUSE_INFO = "getwarehouseinfo";
    
    const GET_WAREHOUSE_LIST = "getwarehouselist";
    
    const CHECK_INVENTORY_TYPE = "checkinventorytype";
    
    //attributes
    public $user_id;
    
    public $warehouse_id;
    
    public $entity_id;
    
    private $inventoryDao;
    
    private $entityDao;
    
    private $warehouse;
    
    public function init() {
        $this->inventoryDao = new InventoryDao();
        $this->entityDao = new EntityDao();
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['warehouse_id', 'integer'],
            ['warehouse_id', 'required', 'on' => [self::GET_WAREHOUSE_INFO]],
            ['warehouse_id', 'isWarehouse'],
            
            ['entity_id', 'integer'],
            ['entity_id', 'required', 'on' => [self::CHECK_INVENTORY_TYPE] ],
            ['entity_id', InInventoryValidator::className(), 'on' => [self::CHECK_INVENTORY_TYPE]]
            
        ];
    }
    
    public function isInventoryType() {
        $this->setScenario(self::CHECK_INVENTORY_TYPE);
        return $this->validate();
    }
    
    public function isWarehouse() {
        $this->warehouse = $this->inventoryDao->getWarehouseInfo($this->warehouse_id);
        if(!$this->warehouse) {
            $this->addError('warehouse_id', 'Not a warehouse');
        }
    }
    
    public function searchSellingWarehouse($query) {
        if(!$this->validate()) {
            return null;
        }
        
        return $this->inventoryDao->searchSellingWarehouse($query);
    }
    
    
    public function searchWarehouse($query) {
        if(!$this->validate()) {
            return null;
        }
        
        return $this->inventoryDao->searchWarehouse($query);
    }
    
    public function getAssetList() {
        if(!$this->validate()) {
            return null;
        }
        $vos = $this->inventoryDao->getAssetList(NULL);
        $models = [];
        $model = [];
        foreach($vos as $vo) {
            $model['code'] = $vo->getEntity()->getCode();
            $model['name'] = $vo->getEntity()->getName();
            $model['method'] = $vo->getMethod();
            $model['fixed_asset'] = $vo->isFixedAsset();
            $model['total'] = $vo->getTotal();
            $models[] = $model;
        }
        return new ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        
    }
    
    public function getInventoryList() {
        if(!$this->validate()) {
            return null;
        }
        $vos = $this->inventoryDao->getInventoryList();
        $models = [];
        $model = [];
        foreach($vos as $vo) {
            $model['product_name'] = $vo->getEntity()->getName();
            $model['warehouse_name'] = $vo->getWarehouse()->getEntity()->getName();
            $model['quantity'] = $vo->getQuantity();
            $models[] = $model;
        }
        return new ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        
    }
    
    public function getWarehouseInfo() {
        $this->setScenario(self::GET_WAREHOUSE_INFO);
        if(!$this->validate()) {
            return null;
        }
        
        return $this->warehouse;
    }
    
    public function getWarehouseList() {
        if(!$this->validate()) {
            return null;
        }
        $vos = $this->inventoryDao->getWarehouseList();
        $models = [];
        $model = [];
        foreach($vos as $vo) {
            $model['id'] = $vo->getEntity()->getId();
            $model['name'] = $vo->getEntity()->getName();
            $model['location'] = $vo->getLocation();
            $model['status'] = $vo->getEntity()->getStatusText();
            $model['selling_place'] = $vo->isSellingPlace();
            $model['active'] = $vo->getEntity()->isActive();
            $model['code'] = $vo->getEntity()->getCode();
            $models[] = $model;
        }
        return new ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
    }
}