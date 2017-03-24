<?php
namespace frontend\services;

use common\validators\DateValidator;
use frontend\daos\SellingDao;
use common\components\RService;
use yii\data\ArrayDataProvider;
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
    
    public $product_id;
    
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
            
            ['product_id', 'integer'],
            ['product_id', 'required', 'on' => self::GET_SELLING_VIEW],
            
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
    
    public function getSellingView() {
        $this->setScenario(self::GET_SELLING_VIEW);
        if(!$this->validate()) {
            return false;
        }
        
        return $this->sellingDao->getSellingView($this->product_id, $this->from, $this->to);
    }

    public function getDailySellingView() {
        $this->setScenario(self::GET_DAILY_SELLING_VIEW);
        if(!$this->validate()) {
            return false;
        }
        
        $models = [];
        $model = [];
        $vos = $this->sellingDao->getDailySellingView($this->date);
        
        foreach($vos as $vo) {
            $model['product'] = $vo->getProduct()->getName();
            $model['buyer'] = $vo->getBuyer()->getName();
            $model['price'] = $vo->getPrice();
            $model['unit'] = $vo->getUnit();
            $model['total'] = $vo->getTotal();
            $models[] = $model;
        }
    
        return new ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
    }


}