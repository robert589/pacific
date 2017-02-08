<?php
namespace frontend\services;

use common\validators\DateValidator;
use frontend\daos\ReportDao;
use common\components\RService;
use common\validators\IsAdminValidator;
/**
 * ReportService service
 *
 */
class ReportService extends RService
{

    const GET_DAILY_REPORT_VIEW = "getdailyreportview";
    
    const GET_REPORT_VIEW = "getreportview";
    //attributes
    public $user_id;
    
    public $ship_id;
    
    public $date;
    
    public $from;
    
    public $to;
    
    private $reportDao;
    
    
    public function init() {
        $this->reportDao = new ReportDao();
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['ship_id', 'integer'],
            ['ship_id', 'required', 'on' => self::GET_DAILY_REPORT_VIEW],
            ['ship_id', 'required', 'on' => self::GET_REPORT_VIEW],
            
            ['date', 'string'],
            ['date', 'required', 'on' => self::GET_DAILY_REPORT_VIEW],
            ['date', DateValidator::className()],
            ['from', 'string'],
            ['from', DateValidator::className()],
            ['from', 'required', 'on' => self::GET_REPORT_VIEW],
            
            ['to', 'string'],
            ['to', 'required', 'on' => self::GET_REPORT_VIEW],
            ['to', DateValidator::className()]
        ];
    }
    public function getDailyReportView() {
        $this->setScenario(self::GET_DAILY_REPORT_VIEW);
        if(!$this->validate()) {
            return false;
        }
    
        return $this->reportDao->getDailyReportView($this->ship_id, $this->date);
    }
    
    public function getCurrentSaldo() {
        if(!$this->validate()) {
            return false;
        }
        
        return $this->reportDao->getCurrentSaldo($this->ship_id);
    }
    
    public function getSaldoAtPoint() {
        if(!$this->validate()) {
            return false;
        }
        
        return $this->reportDao->getSaldoAtPoint($this->ship_id, $this->date);
    }

    public function getReportView() {
        $this->setScenario(self::GET_REPORT_VIEW);
        if(!$this->validate()) {
            return false;
        }
        
        return $this->reportDao->getAllReportsInBetween($this->ship_id, $this->from, $this->to);

        
    }
}