<?php
namespace frontend\daos;

use Yii;
use frontend\vos\EntityVo;
use common\components\Dao;
use common\models\Selling;
use frontend\vos\SellingVo;
/**
 * SellingDao class
 */
class SellingDao implements Dao
{
    const GET_DAILY_SELLING_VIEW = "SELECT selling_info.*, buyer.name as buyer_name
                                    FROM (SELECT *
                                        from selling
                                        where selling.product_id = :product_id and
                                              selling.date = :date and 
                                              selling.status = :status) selling_info 
                                    LEFT JOIN entity buyer 
                                    on buyer.id = selling_info.buyer_id";
    
    const GET_ALL_SELLINGS_IN_BETWEEN = "
                SELECT selling_info.*, buyer.name as buyer_name
                FROM (
                    SELECT * 
                    FROM `selling`
                    WHERE STR_TO_DATE( date, \"%d/%m/%Y\") >= STR_TO_DATE(:from, \"%d/%m/%Y\")
                     AND STR_TO_DATE( date, \"%d/%m/%Y\") <= STR_TO_DATE(:to, \"%d/%m/%Y\")
                     AND selling.product_id = :product_id and status = :status
                    ORDER BY STR_TO_DATE(date, '%d/%m/%Y') ASC
                ) selling_info
                LEFT JOIN entity buyer
                on buyer.id = selling_info.buyer_id;";
    
    const GET_SELLING_INFO = "SELECT selling_info.*, buyer.name as buyer_name
                                FROM (SELECT *
                                    from selling
                                    where selling.id = :selling_id and
                                          selling.status = :status) selling_info 
                                LEFT JOIN entity buyer 
                                on buyer.id = selling_info.buyer_id";
    
    public function getSellingInfo($sellingId, $status = Selling::STATUS_ACTIVE) {
        $result = \Yii::$app->db   
            ->createCommand(self::GET_SELLING_INFO)
            ->bindParam(':selling_id', $sellingId)
            ->bindParam(':status', $status)
            ->queryOne();
        
        $builder = SellingVo::createBuilder();
        $builder->loadData($result);
        $buyerBuilder = EntityVo::createBuilder();
        $buyerBuilder->loadData($result, "buyer");
        $builder->setBuyer($buyerBuilder->build());
        return $builder->build();
    }
    
    public function getSellingView($productId, $from, $to, $status = Selling::STATUS_ACTIVE) {
        $results = \Yii::$app->db
            ->createCommand(self::GET_ALL_SELLINGS_IN_BETWEEN)
            ->bindParam(':product_id', $productId)
            ->bindParam(':status', $status)
            ->bindParam(':from', $from)
            ->bindParam(':to', $to)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = SellingVo::createBuilder();
            $builder->loadData($result);
            $buyerBuilder = EntityVo::createBuilder();
            $buyerBuilder->loadData($result, "buyer");
            $builder->setBuyer($buyerBuilder->build());
            $vos[] = $builder->build();
        }
        
        return $vos;
    
    }
    
    public function getDailySellingView($productId, $date, $status = Selling::STATUS_ACTIVE ) {
        $results = \Yii::$app->db   
            ->createCommand(self::GET_DAILY_SELLING_VIEW)
            ->bindParam(':product_id', $productId)
            ->bindParam(':date', $date)
            ->bindParam(':status', $status)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = SellingVo::createBuilder();
            $builder->loadData($result);
            $buyerBuilder = EntityVo::createBuilder();
            $buyerBuilder->loadData($result, "buyer");
            $builder->setBuyer($buyerBuilder->build());
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
    
}

