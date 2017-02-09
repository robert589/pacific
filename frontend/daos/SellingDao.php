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
                                where selling.ship_id = :ship_id and selling.date = :date and selling.status = :status ";
    
    public function getDailySellingView($shipId, $date, $status = Selling::STATUS_ACTIVE ) {
        $results = \Yii::$app->db
            ->createCommand(self::GET_DAILY_SELLING_VIEW)
            ->bindParam(':ship_id', $shipId)
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

