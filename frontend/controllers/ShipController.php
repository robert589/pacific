<?php
namespace frontend\controllers;

use Yii;
use frontend\widgets\OwnershipGridview;
use frontend\models\AssignShipToOwnerForm;
use common\widgets\SearchFieldDropdownItem;
use frontend\models\CreateShipForm;
use frontend\services\ShipService;
use yii\web\Controller;
/**
 * Ship controller
 */
class ShipController extends Controller
{
    private $service;
    
    public function init() {
        if(Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }
        $this->service = new ShipService();
        $this->service->user_id = Yii::$app->user->getId();
        
    }
    
    public function actionCreate() {
        return $this->render('create-ship', ['id' => 'scs']);
    }
    
    public function actionPCreate() {
        $model = new CreateShipForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $data['status'] = $model->create() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);

    }
    
    public function actionIndex() {
        $provider = $this->service->getAllShips();
        return $this->render('list-ship', ['id' => 'sls', 'provider' => $provider]);
    
    }
    
    public function actionOwnership() {
        return $this->render('ship-ownership', ['id' => 'sso']);
    
        
    }
    
    public function actionSearch() {
        $query = filter_var($_GET['q']);
        $id = filter_var($_GET['id']);
        $data['status'] = 1;
        $views = '';
        $vos = $this->service->searchShips($query);
        foreach($vos as $vo) {
            $views .= SearchFieldDropdownItem::widget(['id' => $id . '-' . $vo->getId(),
                'itemId' => $vo->getId(), 'text' => $vo->getName()]);
        }
        $data['views'] = $views;
        return json_encode($data);
    
    }
    
    
    public function actionAssign() {
        $model = new AssignShipToOwnerForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $data['status'] = $model->assign() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionGetOwnershipGv() {
        $this->service->loadData($_POST);
        $provider = $this->service->getShipOwnership();
        
        if(!$provider) {
            $data['status'] = 0;
            $data['errors'] = $this->service->hasErrors() ? $this->service->getErrors() : null;
            return json_encode($data);
        }
        
        $data['status'] = 1;
        $data['views'] = OwnershipGridview::widget(['id' => 'own-gv', 'provider' => $provider]);
        return json_encode($data);
    }
}

