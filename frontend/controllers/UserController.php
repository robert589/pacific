<?php
namespace frontend\controllers;

use frontend\models\ChangePasswordForm;
use Yii;
use yii\web\Controller;
use frontend\services\UserService;
/**
 * User controller
 */
class UserController extends Controller
{
    private $service;
    
    public function init() {
        $this->service = new UserService();
        $this->service->user_id = \Yii::$app->user->getId();
    }
    
    public function actionChangePassword() {
        return $this->render('change-password', ['id' => 'ucp']);
    }
    
    public function actionProcessChangePassword() {
        $model = new ChangePasswordForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $valid = $model->change();
        $data['status'] = $valid ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }   
    
    public function actionList() {
        $provider = $this->service->getUserList();
        if(!$provider) {
            return $this->redirect(['site/error']);
        }
        return $this->render('list-user', ['id' => 'ulu', 'provider' => $provider]);
    }
    
    public function actionAdd() {
        
    }
    
    public function actionRole() {
        
    }
}

