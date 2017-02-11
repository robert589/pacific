<?php
namespace frontend\controllers;

use Yii;
use frontend\models\ChangeTransactionStatusForm;
use frontend\vos\TransactionVo;
use frontend\widgets\DailyTransactionItem;
use frontend\widgets\DailyTransactionView;
use yii\web\Controller;
use common\models\Transaction;
use frontend\services\TransactionService;
use frontend\models\AddTransactionForm;
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
    
    public function actionCancelRemove() {
        $model = new ChangeTransactionStatusForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->status = Transaction::STATUS_ACTIVE;
        $model->loadData($_POST);
        $valid = $model->change();
        $data['status'] = $valid ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionRemove() {
        $model = new ChangeTransactionStatusForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->status = Transaction::STATUS_DELETED;
        $model->loadData($_POST);
        $valid = $model->change();
        $data['status'] = $valid ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    
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
    
    public function actionPCreate() {
        $model = new AddTransactionForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $transaction = $model->add();
        $data['status'] = $transaction ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        
        if($data['status']) {
            $this->service->transaction_id = $transaction->id;
            $vo = $this->service->getTransactionInfo();
            $data['views'] = DailyTransactionItem::widget(['id' => 'dti-' . $vo->getId(), 'vo' => $vo]);
        }
        
        return json_encode($data);
        

    }
}

