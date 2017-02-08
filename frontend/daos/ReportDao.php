<?php
namespace frontend\daos;

use Yii;
use frontend\vos\ReportVo;
use common\models\Report;
use common\components\Dao;
/**
 * ReportDao class
 */
class ReportDao implements Dao
{
    
    const GET_DAILY_REPORT_VIEW = "SELECT *
                                from report
                                where report.ship_id = :ship_id and report.date = :date and report.status = :status ";
    
    const GET_DAILY_SALDO_AT_POINT = "SELECT sum(debet) - sum(credit) as saldo 
                                    FROM (
                                            SELECT * 
                                        FROM `report` 
                                        where right(date, 4) < right(:date, 4) 
                                        UNION
                                        SELECT * 
                                        FROM report
                                        where right(date,4) = right(:date, 4) and left(right(date,7),2) < left(right(:date,7),2) 
                                        UNION
                                        SELECT *
                                        from report
                                        where right(date,4) = right(:date, 4) and left(right(date,7),2) = left(right(:date,7),2)
                                            and left(date,2) <= left(:date, 4)
                                    ) report_point
                                    where ship_id = :ship_id and status = :status
                                      ";
    
    const GET_CURRENT_SALDO = "SELECT sum(debet) - sum(credit) as saldo
                                FROM report
                                where status = :status and ship_id = :ship_id";
    
    const GET_ALL_REPORTS = "SELECT * FROM report where status = :status";
    
    const GET_ALL_REPORTS_FROM = "SELECT *
                                    FROM (
                                            SELECT * 
                                        FROM `report` 
                                        where right(date, 4) > right(:from, 4) 
                                        UNION
                                        SELECT * 
                                        FROM report
                                        where right(date,4) = right(:from, 4) and left(right(date,7),2) > left(right(:from,7),2) 
                                        UNION
                                        SELECT *
                                        from report
                                        where right(date,4) = right(:from, 4) and left(right(date,7),2) = left(right(:from,7),2)
                                            and left(date,2) >= left(:from, 4)
                                    ) report_point
                                    where ship_id = :ship_id and status = :status";
    
    const GET_ALL_REPORTS_IN_BETWEEN = "
        SELECT * FROM `report`
        WHERE STR_TO_DATE( date, \"%d/%m/%Y\") >= STR_TO_DATE(:from, \"%d/%m/%Y\")
         AND STR_TO_DATE( date, \"%d/%m/%Y\") <= STR_TO_DATE(:to, \"%d/%m/%Y\")
         AND ship_id = :ship_id and status = :status
        ORDER BY STR_TO_DATE(date, '%d/%m/%Y') DESC;";

    public function getAllReportsInBetween($shipId, $from, $to, $status = Report::STATUS_ACTIVE) {
        $results = \Yii::$app->db
            ->createCommand(self::GET_ALL_REPORTS_IN_BETWEEN)
            ->bindParam(':ship_id', $shipId)
            ->bindParam(':from', $from)
            ->bindParam(':to', $to)
            ->bindParam(':status', $status)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = ReportVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;

        
        
    }
    
    public function getAllReportsFrom($shipId, $from, $status = Report::STATUS_ACTIVE) {
        $results = \Yii::$app->db
            ->createCommand(self::GET_ALL_REPORTS_FROM)
            ->bindParam(':ship_id', $shipId)
            ->bindParam(':from', $from)
            ->bindParam(':status', $status)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = ReportVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;

        
    }
    
    public  function getDailyReportView($shipId, $date, $status = Report::STATUS_ACTIVE ) {
        $results = \Yii::$app->db
            ->createCommand(self::GET_DAILY_REPORT_VIEW)
            ->bindParam(':ship_id', $shipId)
            ->bindParam(':date', $date)
            ->bindParam(':status', $status)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = ReportVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;

    }
    
    public function getSaldoAtPoint($shipId, $date, $status = Report::STATUS_ACTIVE) {
        return \Yii::$app->db
            ->createCommand(self::GET_DAILY_SALDO_AT_POINT)
            ->bindParam(':ship_id', $shipId)
            ->bindParam(':date', $date)
            ->bindParam(':status', $status)
            ->queryOne()['saldo'];
        
    }
    
    public function getCurrentSaldo($shipId, $status = Report::STATUS_ACTIVE) {
        return \Yii::$app->db
            ->createCommand(self::GET_CURRENT_SALDO)
            ->bindParam(':ship_id', $shipId)
            ->bindParam(':status', $status)
            ->queryOne()['saldo'];
        
    }
}

