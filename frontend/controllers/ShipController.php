<?php
namespace frontend\controllers;

use Yii;
use common\models\EntityOwner;
use common\models\Entity;
use common\models\EntityType;
use frontend\widgets\OwnershipGridview;
use frontend\models\CreateCodeForm;
use frontend\models\AssignEntityToOwnerForm;
use common\widgets\SearchFieldDropdownItem;
use frontend\models\CreateShipForm;
use frontend\services\ShipService;
use frontend\models\ChangeEntityOwnerStatusForm;
use yii\web\Controller;
use frontend\models\ChangeEntityStatusForm;
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
    
    public function actionEdit() {
        $this->service->ship_id = filter_var($_GET['id']);
        
        $vo = $this->service->getShipInfo();
        if(!$vo) {
            return $this->redirect(['site/error']);
        }
        
        
        return $this->render('edit-ship', ['id' => 'ses', 'vo' => $vo]);
    }
    
    public function actionRemove() {
        $model = new ChangeEntityStatusForm();
        $model->entity_id = filter_input(INPUT_POST, "ship_id");
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $model->status = Entity::STATUS_DELETED;
        $data['status'] = $model->change() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);

    }
    
    public function actionPCreate() {
        $model = new CreateCodeForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->type_id = EntityType::getTypeId(EntityType::SHIP);
        $model->id = filter_input(INPUT_POST, "code");
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
    
    public function actionRemoveOwner() {
        $model = new ChangeEntityOwnerStatusForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->entity_id = filter_input(INPUT_POST, "ship_id");
        $model->status = EntityOwner::STATUS_DELETED;
        $model->loadData($_POST);
        $data['status'] = $model->change() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
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
        $model = new AssignEntityToOwnerForm();
        $model->entity_id = filter_input(INPUT_POST, "ship_id");
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
    
//    
//    public function actionAssignCode() {
//        return $this->render('assign-code-to-ship', ['id' => 'sacts']);
//    }
    
    
}

