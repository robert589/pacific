<?php
namespace frontend\services;

use yii\data\ArrayDataProvider;
use frontend\daos\InventoryDao;
use common\components\RService;
/**
 * InventoryService service
 *
 */
class InventoryService extends RService
{
    
    const GET_WAREHOUSE_LIST = "getwarehouselist";
    //attributes
    public $user_id;
    
    private $inventoryDao;
    
    public function init() {
        $this->inventoryDao = new InventoryDao();
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required']
        ];
    }
    
    public function searchWarehouse($query) {
        if(!$this->validate()) {
            return null;
        }
        
        return $this->inventoryDao->searchWarehouse($query);
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