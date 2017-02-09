<?php
namespace frontend\controllers;

use frontend\widgets\DailySellingView;
use frontend\services\SellingService;
use Yii;
use yii\web\Controller;
/**
 * Selling controller
 */
class SellingController extends Controller
{   
    
    private $service;
    
    public function init() {
        $this->service = new SellingService();
        $this->service->user_id = Yii::$app->user->getId();
    }
    
    public function actionIndex() {
        return $this->render('daily-selling', ['id' => 'sds']);
        
        
    }
    
    public function actionGetDailySellingView()  {
        $this->service->loadData($_POST);
        $vos = $this->service->getDailySellingView();
        
        if (!$vos && !is_array($vos)) {
            $data['status'] = 0;
            $data['errors']  = $this->service->hasErrors() ? $this->service->getErrors() : null;
            return json_encode($data);
        }
        
        $data['status'] = 1;
        $data['views'] = DailySellingView::widget(['id' => 'drv' , 
                            'vos' => $vos, 
                            'shipId' => $this->service->ship_id,
                            'date' => $this->service->date]);
        return json_encode($data);
    }
    

    
    
    
    public function actionDelete() {
        
    }
}

