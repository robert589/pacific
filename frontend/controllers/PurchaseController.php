<?php
namespace frontend\controllers;

use Yii;
use frontend\models\AddPurchaseForm;
use yii\web\Controller;
use frontend\services\PurchaseService;
/**
 * Purchase controller
 */
class PurchaseController extends Controller
{
    private $service;
    
    public function init() {
        if(Yii::$app->user->isGuest) {
            return $this->redirect([]);
        }
        $this->service = new PurchaseService();
        $this->service->user_id = \Yii::$app->user->getId();
        
    }
    
    public function actionIndex() {
        
        $provider = $this->service->getPurchaseList();
        return $this->render('list-purchase', ['id' => 'plp', 'provider' => $provider]);
    }
    
    public function actionPAdd() {
        $model = new AddPurchaseForm();
        $model->loadData($_POST);
        $model->user_id = \Yii::$app->user->getId();
        $valid = $model->add() ? 1 : 0;
        
        $data = [];
        $data['status'] = $valid;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
}

