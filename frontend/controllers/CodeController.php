<?php
namespace frontend\controllers;

use Yii;
use frontend\services\CodeService;
use yii\web\Controller;
/**
 * Code controller
 */
class CodeController extends Controller
{
    
    private $service;
    
    public function init() {
        $this->service = new CodeService();
        $this->service->user_id = Yii::$app->user->getId();
    }
    
    public function actionList() {
        $provider = $this->service->getCodeList();
        return $this->render('list-code', ['id' => 'clc', 'provider' => $provider]);
    }
    
    public function actionType() {
        $provider = $this->service->getCodeTypeList();
        return $this->render('list-code-type', ['id' => 'clct', 'provider' => $provider]);
    }
    
    public function actionCreate() {
        return $this->render('create-code', ['id' => 'ccc']);
    }
}

