<?php
namespace frontend\services;

use common\validators\DateValidator;
use frontend\daos\TransactionDao;
use common\components\RService;
use common\validators\IsAdminValidator;
/**
 * TransactionService service
 *
 */
class TransactionService extends RService
{

    const GET_DAILY_TRANSACTION_VIEW = "getdailytransactionview";
    
    const GET_TRANSACTION_VIEW = "gettransactionview";
    
    const GET_TRANSACTION_INFO = "gettransactioninfo";
    
    //attributes
    public $user_id;
    
    public $ship_id;
    
    public $date;
    
    public $from;
    
    public $to;
    
    public $transaction_id;
    
    private $transactDao;
    
    
    public function init() {
        $this->transactDao = new TransactionDao();
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['transaction_id', 'integer'],
            ['transaction_id' ,'required', 'on' => self::GET_TRANSACTION_INFO],
            
            ['date', 'string'],
            ['date', 'required', 'on' => self::GET_DAILY_TRANSACTION_VIEW],
            ['date', DateValidator::className()],
            ['from', 'string'],
            ['from', DateValidator::className()],
            ['from', 'required', 'on' => self::GET_TRANSACTION_VIEW],
            
            ['to', 'string'],
            ['to', 'required', 'on' => self::GET_TRANSACTION_VIEW],
            ['to', DateValidator::className()]
        ];
    }
    public function getDailyView() {
        $this->setScenario(self::GET_DAILY_TRANSACTION_VIEW);
        if(!$this->validate()) {
            return false;
        }
    
        return $this->transactDao->getDailyTransactionView($this->date);
    }
    
    
    public function getTransactionView() {
        $this->setScenario(self::GET_TRANSACTION_VIEW);
        if(!$this->validate()) {
            return false;
        }
        
        return $this->transactDao->getAllTransactionsInBetween($this->ship_id, $this->from, $this->to);

        
    }
    
    public function getTransactionInfo() {
        $this->setScenario(self::GET_TRANSACTION_INFO);
        if(!$this->validate()) {
            return false;
        }
        
        return $this->transactDao->getTransactionInfo($this->transaction_id);
    }
}