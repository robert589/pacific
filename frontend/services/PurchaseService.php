<?php
namespace frontend\services;

use yii\data\ArrayDataProvider;
use common\components\RService;
use frontend\daos\PurchaseDao;
/**
 * PurchaseService service
 *
 */
class PurchaseService extends RService
{

    //attributes
    public $user_id;
    
    private $purchaseDao;
    
    public function init() {
        $this->purchaseDao = new PurchaseDao();
    }
    
    public function getPurchaseList() {
        if(!$this->validate()) {
            return null;
        }
        
        $vos = $this->purchaseDao->getPurchaseList();
        
        $models = [];
        $model = [];
        
        foreach($vos as $vo) {
            $model['id'] = $vo->getId();
            $model['product_name'] = $vo->getEntity()->getName();
            $model['date'] = $vo->getDate();
            $model['expired_date'] = $vo->getExpiryDate();
            $model['quantity'] = $vo->getQuantity();
            $model['status'] = $vo->getStatusText();
            $model['active'] = $vo->isActive();
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