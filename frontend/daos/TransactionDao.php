<?php
namespace frontend\daos;

use Yii;
use frontend\vos\EntityTypeVo;
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
    
    const GET_TRANSACTION_INFO = "SELECT transaction.*, entity.name as entity_name
                                from transaction, entity
                                where transaction.status = :status and entity.id = transaction.entity_id
                                and transaction.id = :id";
    
    const GET_ALL_TRANSACTIONS_IN_BETWEEN = "
        SELECT transaction.*, entity.name as entity_name
        FROM `transaction`, entity
        WHERE STR_TO_DATE( date, \"%d/%m/%Y\") >= STR_TO_DATE(:from, \"%d/%m/%Y\")
         AND STR_TO_DATE( date, \"%d/%m/%Y\") <= STR_TO_DATE(:to, \"%d/%m/%Y\")
         AND transaction.entity_id = :entity_id and transaction.status = :status 
         and transaction.entity_id = entity.id
        ORDER BY STR_TO_DATE(date, '%d/%m/%Y') DESC;";
    
    const GET_TOTAL_TRANSACTIONS_IN_BETWEEN = "
        SELECT
            sum(transaction.debet) as debet, 
            sum(transaction.credit) as credit, 
            entity.name as entity_name,
            entity_type.id as entity_type_id,
            entity_type.name as entity_type_name
        FROM `transaction`, entity, entity_type
        WHERE STR_TO_DATE( date, \"%d/%m/%Y\") >= STR_TO_DATE(:from, \"%d/%m/%Y\")
         AND STR_TO_DATE( date, \"%d/%m/%Y\") <= STR_TO_DATE(:to, \"%d/%m/%Y\")
         AND transaction.entity_id = :entity_id and transaction.status = :status 
         and transaction.entity_id = entity.id 
         and entity.type_id = entity_type.id
        ORDER BY STR_TO_DATE(date, '%d/%m/%Y') DESC
        limit 1;";

    public function getTransactionInfo($id, $status = Transaction::STATUS_ACTIVE) {
        $result = \Yii::$app->db
            ->createCommand(self::GET_TRANSACTION_INFO)
            ->bindParam(':id', $id)
            ->bindParam(':status', $status)
            ->queryOne();
        $builder = TransactionVo::createBuilder();
        $entityBuilder = EntityVo::createBuilder();
        $entityBuilder->loadData($result, "entity");
        $builder->setEntity($entityBuilder->build());
        $builder->loadData($result);
        return $builder->build();
    }
    
    public function getTotalTransactionsInBetween($entityId, $from, $to, $status = Transaction::STATUS_ACTIVE) {
        $result = \Yii::$app->db
            ->createCommand(self::GET_TOTAL_TRANSACTIONS_IN_BETWEEN)
            ->bindParam(':entity_id', $entityId)
            ->bindParam(':from', $from)
            ->bindParam(':to', $to)
            ->bindParam(':status', $status)
            ->queryOne();
        
        $builder = TransactionVo::createBuilder();
        
        $entityBuilder = EntityVo::createBuilder();
        $entityBuilder->loadData($result, "entity");
        $entityTypeBuilder = EntityTypeVo::createBuilder();
        $entityTypeBuilder->loadData($result, "entity_type");
        $entityBuilder->setEntityType($entityTypeBuilder->build());
        
        $builder->setEntity($entityBuilder->build());

        $builder->loadData($result);
        return $builder->build();
    }
    
    public function getAllTransactionsInBetween($entityId, $from, $to, $status = Transaction::STATUS_ACTIVE) {
        $results = \Yii::$app->db
            ->createCommand(self::GET_ALL_TRANSACTIONS_IN_BETWEEN)
            ->bindParam(':entity_id', $entityId)
            ->bindParam(':from', $from)
            ->bindParam(':to', $to)
            ->bindParam(':status', $status)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = TransactionVo::createBuilder();
            $entityBuilder = EntityVo::createBuilder();
            $entityBuilder->loadData($result, "entity");
            $builder->setEntity($entityBuilder->build());

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

