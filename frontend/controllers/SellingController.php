<?php
namespace frontend\controllers;

use common\models\Selling;
use frontend\models\ChangeSellingStatusForm;
use frontend\widgets\SellingView;
use frontend\vos\SellingVo;
use frontend\widgets\DailySellingItem;
use frontend\models\AddSellingForm;
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
    
    
    public function actionPCreate() {
        $model = new AddSellingForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $data['status'] = $model->add() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionCustom() {
        return $this->render('custom-selling', ['id' => 'scs']);
    }
    
    public function actionGetDailySellingView()  {
        $this->service->loadData($_POST);
        $provider = $this->service->getDailySellingView();
        
        if (!$provider) {
            $data['status'] = 0;
            $data['errors']  = $this->service->hasErrors() ? $this->service->getErrors() : null;
            return json_encode($data);
        }
        $data['status'] = 1;
        $data['views'] = DailySellingView::widget(['id' => 'drv' , 
                            'provider' => $provider,
                            'totalSaldo' => $this->getTotalSaldo($provider),
                            'date' => $this->service->date]);
        return json_encode($data);
    }
    
    
    private function getTotalSaldo($provider) {
        $allModels = $provider->allModels;
        $total = 0;
        foreach($allModels as $model) {
            $total += $model['total'];
        }
        
//        return $total;
    }

    public function actionGetSellingView() {
        $this->service->loadData($_POST);
        
        $provider = $this->service->getSellingView();
        if(!$provider) {
            $data['status'] = 0;
            $data['errors'] = $this->service->hasErrors() ? $this->service->getErrors() : null;
            return json_encode($data);
        }
        $data['status'] = 1;
        $data['views'] = SellingView::widget(['id' => 'rv', 
                            'provider' => $provider]);
        
        return json_encode($data);
        
        
    }

    public function actionRemove() {
        $model = new ChangeSellingStatusForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->status = Selling::STATUS_DELETED;
        $model->loadData($_POST);
        $valid = $model->change();
        $data['status'] = $valid ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    
    }
    
    public function actionCancelRemove() {
        $model = new ChangeSellingStatusForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->status = Selling::STATUS_ACTIVE;
        $model->loadData($_POST);
        $valid = $model->change();
        $data['status'] = $valid ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
}

