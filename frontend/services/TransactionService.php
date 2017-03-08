<?php
namespace frontend\services;

use frontend\daos\CodeDao;
use common\validators\DateValidator;
use frontend\daos\TransactionDao;
use frontend\vos\TransactionVoBuilder;
use common\components\RService;
use frontend\vos\TransactionVo;
use common\validators\AccessValidator;
use frontend\constants\AccessConstants;
/**
 * TransactionService service
 *
 */
class TransactionService extends RService
{

    const GET_DAILY_TRANSACTION_VIEW = "getdailytransactionview";
    
    const GET_TRANSACTION_VIEW = "gettransactionview";
    
    const GET_TRANSACTION_INFO = "gettransactioninfo";
    
    const CHECK_DAILY_TRANSACTION_RIGHTS = "checkcreatedailytransactionrights";
    
    //attributes
    public $user_id;
    
    public $entity_id;
    
    public $date;
    
    public $from;
    
    public $to;
    
    public $transaction_id;
    
    private $transactDao;
    
    private $codeDao;
    
    public function init() {
        $this->transactDao = new TransactionDao();
        $this->codeDao = new CodeDao();
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', AccessValidator::className(), 
                    'access' => AccessConstants::CREATE_DAILY_TRANSACTION, 
                    'on' => [self::CHECK_DAILY_TRANSACTION_RIGHTS]],
            
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
            ['to', DateValidator::className()],
            
            ['entity_id', 'integer'],
            ['entity_id', 'required', 'on' => self::GET_TRANSACTION_VIEW]
                
                
        ];
    }
    
    public function hasDailyTransactionRights() {
        $this->setScenario(self::CHECK_DAILY_TRANSACTION_RIGHTS);
        return $this->validate();
    }
    
    public function getDailyView() {
        $this->setScenario(self::GET_DAILY_TRANSACTION_VIEW);
        if(!$this->validate()) {
            return false;
        }
    
        return $this->transactDao->getDailyTransactionView($this->date);
    }
    
    
    public function getView() {
        $this->setScenario(self::GET_TRANSACTION_VIEW);
        if(!$this->validate()) {
            return false;
        }
        
        $vos = $this->transactDao->getAllTransactionsInBetween($this->entity_id, $this->from, $this->to);
        
        $subcodeVos = $this->codeDao->getSubcode($this->entity_id);
        foreach($subcodeVos as $vo) {
            $vos[] = $this->getSubcodeTransactVo($vo->getId());
        }
        
        return $vos;
    }
    
    private function getSubcodeTransactVo($subcodeId) {
        $builder = TransactionVo::createBuilder();
        $builder->setDate($this->from . ' - ' . $this->to);
        
        $vo = $this->transactDao->getTotalTransactionsInBetween($subcodeId, $this->from, $this->to);
        $builder->setDebet($vo->getDebet());
        $builder->setCredit($vo->getCredit());
        $builder->setEntity($vo->getEntity());
        $builder->setRemark($vo->getEntity()->getEntityType()->getName());

        $subcodeVos = $this->codeDao->getSubcode($subcodeId);
        if(count($subcodeVos) === 0 ) {
            return $builder->build();
        }
        
        foreach($subcodeVos as $vo) {
            $transactSubcodeVo = $this->getSubcodeTransactVo($vo->getId());
            
            $builder->setDebet(floatval($transactSubcodeVo->getDebet()) + floatval($builder->getDebet()));
            $builder->setCredit(floatval($transactSubcodeVo->getCredit()) + floatval($builder->getCredit()));
        }
    
        return $builder->build();
    }
    
    
    public function getTransactionInfo() {
        $this->setScenario(self::GET_TRANSACTION_INFO);
        if(!$this->validate()) {
            return false;
        }
        
        return $this->transactDao->getTransactionInfo($this->transaction_id);
    }
}