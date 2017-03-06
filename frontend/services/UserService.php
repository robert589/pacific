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
    
    //attributes
    public $user_id;
    
    private $userDao;
    
    public function init() {
        $this->userDao = new UserDao();
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required', 'on' => [self::USER_LIST, self::ROLE_LIST] ]
        ];
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
            $model['name'] = $vo->getName();
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
    
}