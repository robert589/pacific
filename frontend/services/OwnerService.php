<?php
namespace frontend\services;

use common\libraries\UserLibrary;
use yii\data\ArrayDataProvider;
use common\validators\IsAdminValidator;
use common\components\RService;
use frontend\daos\OwnerDao;
/**
 * OwnerService service
 *
 */
class OwnerService extends RService
{
    const GET_ALL_OWNERS = "getallowners";

    const SEARCH_OWNERS = "searchowners";
    
    //attributes
    public $user_id;
    
    private $ownerDao;
    
    public function init() {
        $this->ownerDao = new OwnerDao();
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', IsAdminValidator::className(), 'on' => self::GET_ALL_OWNERS],
            ['user_id', 'required']
        ];
    }
    
    public function searchOwners($q) {
        if(!$this->validate()) {
            return false;
        }
        if(UserLibrary::isAdmin($this->user_id)) {
            return $this->ownerDao->searchOwners($q);
        }
        return [];
    }
    
    public function getAllOwners() {
        $this->setScenario(self::GET_ALL_OWNERS);
        if(!$this->validate()) {
            return false;
        }
        
        $vos = $this->ownerDao->getAllOwners();
        $models = [];
        $model = [];
        foreach($vos as $vo) {
            $model['id'] = $vo->getUser()->getId();
            $model['name'] = $vo->getUser()->getName();
            $models[] = $model;
        }
        
        return new ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
    }
    
}