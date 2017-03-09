<?php
namespace frontend\controllers;

use frontend\models\RemoveOwnerFromCodeForm;
use common\models\EntityOwner;
use frontend\models\AddOwnerToCodeForm;
use frontend\models\EditCodeTypeForm;
use Yii;
use frontend\models\EditEntityForm;
use frontend\models\ChangeEntityStatusForm;
use common\models\Entity;
use common\models\EntityType;
use frontend\models\RemoveAllEntityRelationsForm;
use frontend\models\RemoveEntityRelationForm;
use frontend\models\AddEntityRelationForm;
use common\widgets\SearchFieldDropdownItem;
use frontend\models\CreateCodeTypeForm;
use frontend\models\AddEntityRelationRangeForm;
use frontend\models\ChangeEntityTypeStatusForm;
use frontend\services\CodeService;
use yii\web\Controller;
use frontend\models\CreateCodeForm;

/**
 * Code controller
 */
class CodeController extends Controller
{
    
    private $service;
    
    public function init() {
        $this->service = new CodeService();
        $this->service->user_id = Yii::$app->user->getId();
    }
    
    public function actionIndex() {
        
        $provider = $this->service->getCodeList();
        if(!$provider) {
            return $this->redirect(['site/error']);
        }
        return $this->render('list-code', ['id' => 'clc', 'provider' => $provider]);
    }
    
    public function actionType() {
        $provider = $this->service->getCodeTypeList();
        return $this->render('list-code-type', ['id' => 'clct', 'provider' => $provider]);
    }
    
    public function actionEditType() {
        $this->service->entity_type_id = filter_input(INPUT_GET, "id");
        $vo = $this->service->getEntityTypeInfo();
        return $this->render('edit-code-type', ['id' => 'cect', 'vo' => $vo]);
        
    }
    
    public function actionPEditType() {
        $model = new EditCodeTypeForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $data['status'] = $model->edit() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionRemoveType() {
        $model = new ChangeEntityTypeStatusForm();
        $model->status = EntityType::STATUS_DELETED;
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $data = [];
        $data['status'] = $model->change() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionCreateType() {
        return $this->render('create-code-type', ['id' => 'ccct']);
    }
    
    public function actionSearchType() {
        $query = filter_var($_GET['q']);
        $id = filter_var($_GET['id']);
        $data['status'] = 1;
        $views = '';
        $vos = $this->service->searchType($query);
        if(count($vos) !== 0) {
            foreach($vos as $vo) {
                $views .= SearchFieldDropdownItem::widget(['id' => $id . '-' . $vo->getId(),
                    'itemId' => $vo->getId(), 'text' => $vo->getName()]);
            }   
        } else {
            $views = "No Matching found";
        }
        $data['views'] = $views;
        return json_encode($data);

    }
    
    public function actionSearch() {
        $query = filter_var($_GET['q']);
        $id = filter_var($_GET['id']);
        $data['status'] = 1;
        $views = '';
        $vos = $this->service->search($query);
        if(count($vos) !== 0) {
            foreach($vos as $vo) {
                $views .= SearchFieldDropdownItem::widget(['id' => $id . '-' . $vo->getId(),
                    'itemId' => $vo->getId(), 'text' => $vo->getCode() . '. ' . $vo->getName()]);
            }   
        } else {
            $views = "No Matching Found";
        }
        $data['views'] = $views;
        return json_encode($data);
    }
    
    public function actionPCreateType() {
        $model = new CreateCodeTypeForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $data['status'] = $model->create() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionCreate() {
        return $this->render('create-code', ['id' => 'ccc']);
    }
    
    public function actionAddRelation() {
        $this->service->entity_id = filter_var($_GET['id']);
        $vo = $this->service->getEntityInfoWithChild();
        $provider = $this->service->getSubCode();
        if(!$vo) {
            return $this->redirect(['site/error']);
        }
        return $this->render('add-entity-relation', 
                ['id' => 'caer', 'vo' => $vo, 'provider' => $provider]);
    }
    
    public function actionRemoveRelation() {
        $model = new RemoveEntityRelationForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        
        $data = [];
        $data['status'] = $model->remove() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionRemoveAllRelation() {
        $model = new RemoveAllEntityRelationsForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        
        $data = [];
        $data['status'] = $model->removeAll() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionPCreate() {
        $model = new CreateCodeForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $data['status'] = $model->create() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionAddEntity() {
        $model = new AddEntityRelationForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        
        $data = [];
        $data['status'] = $model->add() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    
    public function actionAddRelationRange() {
        $model = new AddEntityRelationRangeForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        
        $data = [];
        $data['status'] = $model->add() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionEdit() {
        $this->service->entity_id = filter_input(INPUT_GET, "id");
        $vo = $this->service->getEntityInfoForEdit();
        return $this->render('edit-code', ['id' => 'cec', 'vo' => $vo]);
        
    }
               
    public function actionPEdit() {
        $model = new EditEntityForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $data['status'] = $model->edit() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    
    public function actionRemove() {
        $model = new ChangeEntityStatusForm();
        $model->status = Entity::STATUS_DELETED;
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        
        $data = [];
        $data['status'] = $model->change(true) ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionView() {
        $this->service->entity_id = filter_input(INPUT_GET, "id");
        $entityVo = $this->service->getEntityInfo();
        $ownerProvider = $this->service->getAllOwners();
        return $this->render('view-code', ['id' => 'cvc', 'ownerProvider' => $ownerProvider, 'entityVo' => $entityVo]);
    }
    
    public function actionAddOwner() {
        $model = new AddOwnerToCodeForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        
        $data = [];
        $data['status'] = $model->add() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    
    }
    
    public function actionRemoveOwner() {
        
        $model = new RemoveOwnerFromCodeForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        
        $data = [];
        $data['status'] = $model->remove() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
}

