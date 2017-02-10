<?php
namespace frontend\daos;

use Yii;
use frontend\vos\TransactionVo;
use common\models\Transaction;
use common\components\Dao;
use frontend\vos\EntityVo;
/**
 * ReportDao class
 */
class TransactionDao implements Dao
{
    
    const GET_DAILY_TRANSACTION_VIEW = "SELECT transaction.*, entity.name as entity_name
                                from transaction, entity
                                where transaction.date = :date
                                and transaction.status = :status and entity.id = transaction.entity_id";
    
    const GET_ALL_TRANSACTIONS_IN_BETWEEN = "
        SELECT * FROM `transaction`
        WHERE STR_TO_DATE( date, \"%d/%m/%Y\") >= STR_TO_DATE(:from, \"%d/%m/%Y\")
         AND STR_TO_DATE( date, \"%d/%m/%Y\") <= STR_TO_DATE(:to, \"%d/%m/%Y\")
         AND ship_id = :ship_id and status = :status
        ORDER BY STR_TO_DATE(date, '%d/%m/%Y') DESC;";

    public function getAllTransactionsInBetween($shipId, $from, $to, $status = Transaction::STATUS_ACTIVE) {
        $results = \Yii::$app->db
            ->createCommand(self::GET_ALL_TRANSACTIONS_IN_BETWEEN)
            ->bindParam(':ship_id', $shipId)
            ->bindParam(':from', $from)
            ->bindParam(':to', $to)
            ->bindParam(':status', $status)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = TransactionVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;

        
        
    }
    
    public  function getDailyTransactionView($date, $status = Transaction::STATUS_ACTIVE ) {
        $results = \Yii::$app->db
            ->createCommand(self::GET_DAILY_TRANSACTION_VIEW)
            ->bindParam(':date', $date)
            ->bindParam(':status', $status)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = TransactionVo::createBuilder();
            $builder->loadData($result);
            $entityBuilder = EntityVo::createBuilder();
            $entityBuilder->loadData($result, "entity");
            $builder->setEntity($entityBuilder->build());
            $vos[] = $builder->build();
        }
        
        return $vos;

    }
    
}

