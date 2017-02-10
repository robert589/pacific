<?php
namespace frontend\controllers;

use Yii;
use frontend\widgets\DailyTransactionView;
use yii\web\Controller;
use frontend\services\TransactionService;
/**
 * Transaction controller
 */
class TransactionController extends Controller
{
    private $service;
    
    public function init() {
        $this->service = new TransactionService();  
        $this->service->user_id = Yii::$app->user->getId();
    }
    
    public function actionIndex() {
        return $this->render('daily-transaction' ,['id' => 'tdt']);
    }
    
    public function actionGetDailyView() {
        $data['status'] = 1;
        $this->service->loadData($_POST);
        $vos = $this->service->getDailyView();
        
        if (!$vos && !is_array($vos)) {
            $data['status'] = 0;
            $data['errors']  = $this->service->hasErrors() ? $this->service->getErrors() : null;
            return json_encode($data);
        }
        
        $data['views'] = DailyTransactionView::widget(['id' => 'dtv' , 
                            'vos' => $vos, 
                            'date' => $this->service->date]);
        return json_encode($data);

    }
}

