<?php
namespace frontend\controllers;

use Yii;
use frontend\models\AddWarehouseForm;
use frontend\services\InventoryService;
use frontend\models\EditWarehouseForm;
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
    
    public function actionInInventory() {
        $this->service->loadData($_POST);
        $data = [];
        $data['status'] = !$this->service->hasErrors() ? 1 : 0;
        $data['in'] = $this->service->isInventoryType() ? 1 : 0;
        $data['errors'] = $this->service->getErrors();
        return json_encode($data);
        
        
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
    
    public function actionEditWarehouse() {
        $this->service->warehouse_id = filter_input(INPUT_GET, "id");
        $vo = $this->service->getWarehouseInfo();
        if(!$vo) {
            return $this->render('../site/error');
        }
        
        return $this->render('edit-warehouse', ['id' => 'iew', 'vo' => $vo]);
        
    }
    
    public function actionPEditWh() {
        $data = array();
        $model = new EditWarehouseForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $data['status'] = $model->edit() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionSearchSellingWh() {
        $id = filter_var($_GET['id']);
        $query = filter_var($_GET['q']);
        $vos = $this->service->searchSellingWarehouse($query);
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

