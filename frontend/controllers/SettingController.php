<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
/**
 * Setting controller
 */
class SettingController extends Controller
{
    
    public function actionIndex() {
        return $this->render('system-setting', ['id' => 'sss']);
    }
}

