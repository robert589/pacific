<?php
namespace frontend\daos;

use Yii;
use common\components\Dao;
use common\models\Selling;
use frontend\vos\SellingVo;
/**
 * SellingDao class
 */
class SellingDao implements Dao
{
    const GET_DAILY_SELLING_VIEW = "SELECT *
                                from selling
                                where selling.entity_id = :entity_id and selling.date = :date and selling.status = :status ";
    
    const GET_ALL_SELLINGS_IN_BETWEEN = "
                    SELECT * FROM `selling`
                    WHERE STR_TO_DATE( date, \"%d/%m/%Y\") >= STR_TO_DATE(:from, \"%d/%m/%Y\")
                     AND STR_TO_DATE( date, \"%d/%m/%Y\") <= STR_TO_DATE(:to, \"%d/%m/%Y\")
                     AND entity_id = :entity_id and status = :status
                    ORDER BY STR_TO_DATE(date, '%d/%m/%Y') ASC;";
    
    public function getSellingView($entityId, $date, $from, $to, $status = Selling::STATUS_ACTIVE) {
        $results = \Yii::$app->db
            ->createCommand(self::GET_ALL_SELLINGS_IN_BETWEEN)
            ->bindParam(':entity_id', $entityId)
            ->bindParam(':status', $status)
            ->bindParam(':from', $from)
            ->bindParam(':to', $to)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = SellingVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;
    
    }
    
    public function getDailySellingView($entityId, $date, $status = Selling::STATUS_ACTIVE ) {
        $results = \Yii::$app->db   
            ->createCommand(self::GET_DAILY_SELLING_VIEW)
            ->bindParam(':entity_id', $entityId)
            ->bindParam(':date', $date)
            ->bindParam(':status', $status)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = SellingVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;

    }
    
}

