<?php
namespace frontend\services;

use yii\data\ArrayDataProvider;
use frontend\daos\UserDao;
use common\components\RService;
/**
 * UserService service
 *
 */
class UserService extends RService
{
    
    const USER_LIST = "userlist";
    
    const ROLE_LIST = "rolelist";
    
    const ACCESS_CONTROL_LIST = "accesscontrollist";
    
    //attributes
    public $user_id;
    
    private $userDao;
    
    public function init() {
        $this->userDao = new UserDao();
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required', 'on' => [self::USER_LIST, self::ROLE_LIST, self::ACCESS_CONTROL_LIST] ]
        ];
    } 
    
    public function getAccessControlList() {
        $this->setScenario(self::ACCESS_CONTROL_LIST);
        if(!$this->validate()) {
            return null;
        }
        
        $vos = $this->userDao->getAccessControlList();
        $models = [];
        foreach($vos as $vo) {
            $model = [];
            $model['id'] = $vo->getId();
            $model['name'] = $vo->getName();
            $model['description'] = $vo->getDescription();
            $model['code'] = $vo->getCode();
            $models[] = $model;
            
        }
        
        return new ArrayDataProvider([
            'allModels' => $models,
            'pagination' =>[
                'pageSize' => 10
            ]
        ]);
    }
    
    public function getRoleList() {
        $this->setScenario(self::ROLE_LIST);
        if(!$this->validate()) {
            return null;
        }
        
        $vos = $this->userDao->getRoleList();
        $models = [];
        foreach($vos as $vo) {
            $model = [];
            $model['id'] = $vo->getId();
            $model['name'] = $vo->getName();
            $model['description'] = $vo->getDescription();
            $model['status'] = $vo->getStatusText();
            $model['active'] = $vo->isActive() ? 1 : 0;
            $model['rights'] = $vo->getRights();
            $models[] = $model;
            
        }
        
        return new ArrayDataProvider([
            'allModels' => $models,
            'pagination' =>[
                'pageSize' => 10
            ]
        ]);
    }
    
    public function getUserList() {
        $this->setScenario(self::USER_LIST);
        if(!$this->validate()) {
            return null;
        }
        
        $vos = $this->userDao->getUserList();
        $models = [];
        foreach($vos as $vo) {
            $model = [];
            $model['id'] = $vo->getId();
            $model['active'] = $vo->isActive() ? 1 : 0;
            $model['name'] = $vo->getName();
            $model['roles'] = $vo->getRoles();
            $model['status'] = $vo->getStatusText();
            $models[] = $model;
            
            
            
        }
        
        return new ArrayDataProvider([
            'allModels' => $models,
            'pagination' =>[
                'pageSize' => 10
            ]
        ]);
    }
    
    public function searchRole($q) {
        if(!$this->validate()) {
            return null;
        }
        
        return $this->userDao->searchRole($q);
    }
    
    public function searchRights($q) {
        if(!$this->validate()) {
            return null;
        }
        
        return $this->userDao->searchRights($q);
    }
}