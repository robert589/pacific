<?php
namespace frontend\controllers;

use frontend\models\ChangePasswordForm;
use Yii;
use yii\web\Controller;
/**
 * User controller
 */
class UserController extends Controller
{
    
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
}

