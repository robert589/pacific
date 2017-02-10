<?php
namespace frontend\controllers;

use Yii;
use common\widgets\SearchFieldDropdownItem;
use frontend\models\CreateCodeTypeForm;
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
    
    public function actionPCreate() {
        $model = new CreateCodeForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $data['status'] = $model->create() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
}

