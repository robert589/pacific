<?php
namespace frontend\controllers;

use Yii;
use frontend\models\AddWarehouseForm;
use frontend\services\InventoryService;
use common\widgets\SearchFieldDropdownItem;
use yii\web\Controller;
/**
 * Inventory controller
 */
class InventoryController extends Controller
{
    
    private $service;
    
    public function init() {
        $this->service = new InventoryService();
        $this->service->user_id = \Yii::$app->user->getId();
    }
    
    /**
     * List Warehouse
     */
    public function actionListWarehouse() {
        $provider = $this->service->getWarehouseList();
        return $this->render('list-warehouse', ['id' => 'ilw', 'provider' => $provider]);
    }
    
    public function actionIndex() {
        $provider = $this->service->getInventoryList();
        return $this->render('list-inventory', ['id' => 'ili', 'provider' => $provider]);
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

    public function actionSearchWarehouse() {
        $id = filter_var($_GET['id']);
        $query = filter_var($_GET['q']);
        $vos = $this->service->searchWarehouse($query);
        $views = '';
        if(count($vos) !== 0) {
            foreach($vos as $vo) {
                $views .= SearchFieldDropdownItem::widget(['id' => $id . $vo->getEntity()->getId(), 'itemId' => $vo->getEntity()->getId(), 
                    'text' => $vo->getEntity()->getName()]);
            }
            $data = array();
            $data['status'] = 1;
            $data['views'] = $views;
        } else {
            $data['status'] = 1;
            $data['views'] = 'No Matching Found';
        }
        
        return json_encode($data);
    }
    
}

