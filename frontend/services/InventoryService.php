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
    
    public function getWarehouseList() {
        $vos = $this->inventoryDao->getWarehouseList();
        
        $models = [];
        $model = [];
        
        foreach($vos as $vo) {
            $model['id'] = $vo->getEntity()->getId();
            $model['name'] = $vo->getEntity()->getName();
            $model['location'] = $vo->getEntity()->getLocation();
            $model['status'] = $vo->getEntity()->getStatusText();
            $model['active'] = $vo->getEntity()->isActive();
            $model['code'] = $vo->getEntity()->getCode();
            
            $models[] = $model;
            
        }
        
        return new ArrayDataProvider([
            'allModels' => $model,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
    }
}