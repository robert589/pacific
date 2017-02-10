<?php
namespace frontend\controllers;

use Yii;
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
    }
    
    public function actionIndex() {
        return $this->render('daily-transaction' ,['id' => 'tdt']);
    }
    
    
}

