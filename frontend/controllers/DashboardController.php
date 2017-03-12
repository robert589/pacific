<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
/**
 * Dashboard controller
 */
class DashboardController extends Controller
{
    
    private $service;
    
    public function init() {
        
    }
    
    public function actionIndex() {
        return $this->render('view-dashboard', ['id' => 'dvd']);
    }
}

