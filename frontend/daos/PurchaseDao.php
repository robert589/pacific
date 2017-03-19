<?php
namespace frontend\daos;

use Yii;
use common\components\Dao;
use common\models\Purchase; 
use frontend\vos\PurchaseVo;
use frontend\vos\EntityVo;
/**
 * PurchaseDao class
 */
class PurchaseDao implements Dao
{
    const GET_PURCHASE_LIST = "SELECT purchase.*, entity.name as entity_name
                                FROM purchase, entity
                                where purchase.entity_id = entity.id and
                                    entity.status = IFNULL(:status , entity.status)";
    
    public function getPurchaseList($status = Purchase::STATUS_ACTIVE) {
        
        $results =  \Yii::$app->db
            ->createCommand(self::GET_PURCHASE_LIST)
            ->bindParam(':status', $status)
            ->queryAll();
        
        $vos = [];
        
        foreach($results as $result) {
            $builder = PurchaseVo::createBuilder();
            $builder->loadData($result);
           
            $entityBuilder = EntityVo::createBuilder();
            $entityBuilder->loadData($result, "entity");
            
            $builder->setEntity($entityBuilder->build());
            
            $vos[] = $builder->build();
            
        }
        
        return $vos;
        
        
    }
}

