<?php
namespace frontend\controllers;

use Yii;
use frontend\widgets\ReportView;
use frontend\models\ChangeReportStatus; 
use common\models\Report;
use frontend\vos\ReportVo;
use yii\web\Controller;
use frontend\services\ReportService;
use frontend\widgets\DailyReportView;
use frontend\models\AddReportForm;
use frontend\widgets\DailyReportItem;
/**
 * Report controller
 */
class ReportController extends Controller
{
    private $service;
    
    public function init() {
        if(Yii::$app->user->isGuest) {
            return $this->redirect(['site/error']);
        }
        
        $this->service = new ReportService();
        $this->service->user_id = Yii::$app->user->getId();
        
    }
    
    public function actionIndex() {
        return $this->render('daily-report', ['id' => 'rdr']);
    }
    
    public function actionPCreate() {
        $model = new AddReportForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $report = $model->add();
        $data['status'] = $report ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        
        if($data['status']) {
            $builder = ReportVo::createBuilder();
            $builder->setId($report->id);
            $builder->setShipId($report->ship_id);
            $builder->setRemark($report->remark);
            $builder->setDebet($report->debet);
            $builder->setCredit($report->credit);
            $builder->setStatus($report->status);
            $builder->setHighlight($report->highlight);
            $data['views'] = DailyReportItem::widget(['id' => 'dri-' . $builder->getId(), 'vo' => $builder->build()]);
        }
        
        return json_encode($data);
        
    }

    public function actionGetDailyReportView() {
        $data['status'] = 1;
        $this->service->loadData($_POST);
        $vos = $this->service->getDailyReportView();
        
        if (!$vos && !is_array($vos)) {
            $data['status'] = 0;
            $data['errors']  = $this->service->hasErrors() ? $this->service->getErrors() : null;
            return json_encode($data);
        }
        
        $data['views'] = DailyReportView::widget(['id' => 'drv' , 
                            'vos' => $vos, 
                            'shipId' => $this->service->ship_id,
                            'currentSaldo' => $this->service->getCurrentSaldo(),
                            'saldoAtPoint' => $this->service->getSaldoAtPoint(),
                            'date' => $this->service->date]);
        return json_encode($data);
    }
    
    public function actionRemove() {
        $model = new ChangeReportStatus();
        $model->user_id = \Yii::$app->user->getId();
        $model->status = Report::STATUS_DELETED;
        $model->loadData($_POST);
        $data['status'] = $model->change() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? 
                $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionCancelRemove() {
        $model = new ChangeReportStatus();
        $model->user_id = \Yii::$app->user->getId();
        $model->status = Report::STATUS_ACTIVE;
        $model->loadData($_POST);
        $data['status'] = $model->change() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? 
                $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionCustom() {
        return $this->render('custom-report', ['id' => 'rcr']);
    }
    
    public function actionGetReportView() {
        $this->service->loadData($_POST);
        
        $vos = $this->service->getReportView();
        if(!is_array($vos)) {
            $data['status'] = 0;
            $data['errors'] = $this->service->hasErrors() ? $this->service->getErrors() : null;
            return json_encode($data);
        }
        $data['status'] = 1;
        $data['views'] = ReportView::widget(['id' => 'rv', 'vos' => $vos,
                               'shipId' => $this->service->ship_id,
                            'currentSaldo' => $this->service->getCurrentSaldo(),
                            'saldoAtPoint' => $this->service->getSaldoAtPoint(),
                            'date' => $this->service->date]);
        
        return json_encode($data);
        
        
    }
}

