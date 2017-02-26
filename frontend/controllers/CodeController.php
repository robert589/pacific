<?php
namespace frontend\controllers;

use Yii;
use frontend\models\EditEntityForm;
use frontend\models\ChangeEntityStatusForm;
use common\models\Entity;
use frontend\models\RemoveAllEntityRelationsForm;
use frontend\models\RemoveEntityRelationForm;
use frontend\models\AddEntityRelationForm;
use common\widgets\SearchFieldDropdownItem;
use frontend\models\CreateCodeTypeForm;
use frontend\models\AddEntityRelationRangeForm;
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
    
    public function actionCreateType() {
        return $this->render('create-code-type', ['id' => 'ccct']);
    }
    
    public function actionSearchType() {
        $query = filter_var($_GET['q']);
        $id = filter_var($_GET['id']);
        $data['status'] = 1;
        $views = '';
        $vos = $this->service->searchType($query);
        foreach($vos as $vo) {
            $views .= SearchFieldDropdownItem::widget(['id' => $id . '-' . $vo->getId(),
                'itemId' => $vo->getId(), 'text' => $vo->getName()]);
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
        foreach($vos as $vo) {
            $views .= SearchFieldDropdownItem::widget(['id' => $id . '-' . $vo->getId(),
                'itemId' => $vo->getId(), 'text' => $vo->getCode() . '. ' . $vo->getName()]);
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
}

