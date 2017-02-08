<?php
namespace frontend\controllers;

use frontend\models\AssignShipToOwnerForm;
use frontend\models\CreateOwnerForm;
use Yii;
use common\widgets\SearchFieldDropdownItem;
use frontend\services\OwnerService;
use yii\web\Controller;
/**
 * Owner controller
 */
class OwnerController extends Controller
{
    
    private $service;
    
    public function init() {
        $this->service = new OwnerService();
        $this->service->user_id = \Yii::$app->user->getId();
    }
    
    public function actionCreate() {
        return $this->render('create-owner', ['id' => 'oco']);
    }

    public function actionPCreate() {
        $model = new CreateOwnerForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $data['status'] = $model->create() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionIndex() {
        $provider = $this->service->getAllOwners();
        
        return $this->render('list-owner', ['id' => 'olo', 'provider' => $provider]);
    }
    
    public function actionSearch() {
        $query = filter_var($_GET['q']);
        $id = filter_var($_GET['id']);
        $data['status'] = 1;
        $views = '';
        $vos = $this->service->searchOwners($query);
        foreach($vos as $vo) {
            $views .= SearchFieldDropdownItem::widget(['id' => $id . '-' . $vo->getUser()->getId(),
                'itemId' => $vo->getUser()->getId(), 'text' => ucfirst($vo->getUser()->getName())]);
        }
        $data['views'] = $views;
        return json_encode($data);
    }
    
}

