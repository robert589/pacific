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
        $selling = $model->add();
        $data['status'] = $selling ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        
        if($data['status']) {
            $builder = SellingVo::createBuilder();
            $builder->setId($selling->id);
            $builder->setShipId($selling->entity_id);
            $builder->setRemark($selling->remark);
            $builder->setDate($selling->date);
            $builder->setStatus($selling->status);
            $builder->setTonase($selling->tonase);
            $builder->setPrice($selling->price);
            $builder->setTotal($selling->total);
            
            $data['views'] = 
                    DailySellingItem::widget(
                            ['id' => 'dsi-' . $builder->getId(), 'vo' => $builder->build()]);
        }
        
        return json_encode($data);
        
    }
    
    public function actionCustom() {
        return $this->render('custom-selling', ['id' => 'scs']);
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
    

    public function actionGetSellingView() {
        $this->service->loadData($_POST);
        
        $vos = $this->service->getSellingView();
        if(!is_array($vos)) {
            $data['status'] = 0;
            $data['errors'] = $this->service->hasErrors() ? $this->service->getErrors() : null;
            return json_encode($data);
        }
        $data['status'] = 1;
        $data['views'] = SellingView::widget(['id' => 'rv', 'vos' => $vos,
                               'shipId' => $this->service->ship_id,
                            'currentSaldo' => "0",
                            'date' => $this->service->date]);
        
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

