<?php
namespace frontend\services;

use common\validators\DateValidator;
use frontend\daos\SellingDao;
use common\components\RService;
/**
 * SellingService service
 *
 */
class SellingService extends RService
{
    const GET_DAILY_SELLING_VIEW = "getdailysellingview";

    const GET_SELLING_VIEW = "getsellingview";

    //attributes
    public $user_id;    
    
    public $ship_id;
    
    public $date;
    
    public $from;
    
    public $to;
    
    private $sellingDao;
    
    public function init() {
        $this->sellingDao = new SellingDao();
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['ship_id', 'integer'],
            ['ship_id', 'required', 'on' => self::GET_DAILY_SELLING_VIEW],
            ['ship_id', 'required', 'on' => self::GET_SELLING_VIEW],
            
            ['date', 'string'],
            ['date', 'required', 'on' => self::GET_DAILY_SELLING_VIEW],
            ['date', DateValidator::className()],
            ['from', 'string'],
            ['from', DateValidator::className()],
            ['from', 'required', 'on' => self::GET_SELLING_VIEW],
            
            ['to', 'string'],
            ['to', 'required', 'on' => self::GET_SELLING_VIEW],
            ['to', DateValidator::className()]
        ];
    }
    public function getDailySellingView() {
        $this->setScenario(self::GET_DAILY_SELLING_VIEW);
        if(!$this->validate()) {
            return false;
        }
    
        return $this->sellingDao->getDailySellingView($this->ship_id, $this->date);
    }


}