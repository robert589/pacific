<?php
namespace frontend\controllers;

use Yii;
use frontend\models\AddWarehouseForm;
use frontend\services\InventoryService;
use yii\web\Controller;
/**
 * Inventory controller
 */
class InventoryController extends Controller
{
    
    private $service;
    
    public function init() {
        $this->service = new InventoryService();
    }
    
    /**
     * List Warehouse
     */
    public function actionIndex() {
        $provider = $this->service->getWarehouseList();
        return $this->render('list-warehouse', ['id' => 'ilw', 'provider' => $provider]);
    }
    public function actionPAddWh() {
        $data = array();
        $model = new AddWarehouseForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $data['status'] = $model->create() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionAddWarehouse() {
        return $this->render('add-warehouse', ['id' => 'iaw']);
    }
}

