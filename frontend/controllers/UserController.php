<?php
namespace frontend\controllers;

use frontend\models\AssignRightsToRoleForm;
use frontend\models\RemoveRoleFromUserForm;
use frontend\models\AddRoleToUserForm;
use common\widgets\SearchFieldDropdownItem;
use frontend\models\AddRoleForm;
use frontend\models\SignupForm;
use frontend\models\ChangePasswordForm;
use Yii;
use yii\web\Controller;
use frontend\services\UserService;
/**
 * User controller
 */
class UserController extends Controller
{
    private $service;
    
    public function init() {
        $this->service = new UserService();
        $this->service->user_id = \Yii::$app->user->getId();
    }
    
    public function actionChangePassword() {
        return $this->render('change-password', ['id' => 'ucp']);
    }
    
    public function actionProcessChangePassword() {
        $model = new ChangePasswordForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $valid = $model->change();
        $data['status'] = $valid ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }   
    
    public function actionList() {
        $provider = $this->service->getUserList();
        if(!$provider) {
            return $this->redirect(['site/error']);
        }
        return $this->render('list-user', ['id' => 'ulu', 'provider' => $provider]);
    }
    
    public function actionAdd() {
        return $this->render('add-user', ['id' => 'uau']);
    }
    
    public function actionPAdd() {
        $model =new SignupForm();
        $model->first_name = filter_input(INPUT_POST, "first_name");
        $model->last_name = filter_input(INPUT_POST, "last_name");
        $model->email = filter_input(INPUT_POST, "email");
        $model->password = filter_input(INPUT_POST, "password");
        
        $data['status'] = $model->signup()  ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
        
    }
    
    public function actionAddRole() {
        return $this->render('add-role', ['id' => 'uar']);
    }
    
    public function actionPAddRole() {
        $model = new AddRoleForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $valid = $model->add();
        $data['status'] = $valid ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionRole() {
        $provider = $this->service->getRoleList();
        if(!$provider) {
        
            return $this->redirect(['site/error']);
        }
        return $this->render('list-role', ['id' => 'ulr', 'provider' => $provider]);
    }
    
    public function actionSearchRights() {
        $id = filter_var($_GET['id']);
        $query = filter_var($_GET['q']);
        $vos = $this->service->searchRights($query);
        $views = '';
        if(count($vos) !== 0) {
            foreach($vos as $vo) {
                $views .= SearchFieldDropdownItem::widget(['id' => $id . $vo->getId(), 'itemId' => $vo->getId(), 
                    'text' => $vo->getName()]);
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
    
    public function actionSearchRole() {
        $id = filter_var($_GET['id']);
        $query = filter_var($_GET['q']);
        $vos = $this->service->searchRole($query);
        $views = '';
        if(count($vos) !== 0) {
            foreach($vos as $vo) {
                $views .= SearchFieldDropdownItem::widget(['id' => $id . $vo->getId(), 'itemId' => $vo->getId(), 
                    'text' => $vo->getName()]);
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
    
    public function actionAssignRole() {
        $model = new AddRoleToUserForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $valid = $model->add();
        $data['status'] = $valid ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionAssignAccess() {
        $model = new AssignRightsToRoleForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $valid = $model->assign();
        $data['status'] = $valid ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionRemoveRole() {
        $model = new RemoveRoleFromUserForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $valid = $model->remove();
        $data['status'] = $valid ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
        
    }
    
}

