<?php
namespace frontend\services;

use yii\data\ArrayDataProvider;
use common\libraries\UserLibrary;
use common\validators\IsAdminValidator;
use common\components\RService;
use frontend\daos\ShipDao;
/**
 * ShipService service
 *
 */
class ShipService extends RService
{
    const GET_ALL_SHIPS = "getallships";
    
    const GET_SHIP_OWNERSHIP = "getshipownership";
    
    //attributes
    public $user_id;
    
    private $shipDao;
    
    public $ship_id;
    
    public function init() {
        $this->shipDao = new ShipDao();
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['ship_id', 'integer'],
            ['ship_id', 'required', 'on' => self::GET_SHIP_OWNERSHIP]
        ];
    }
    
    public function getShipOwnership() {
        $this->setScenario(self::GET_SHIP_OWNERSHIP);
        if(!$this->validate()) {
            return false;
        }
        
        $vos =  $this->shipDao->getShipOwnership($this->ship_id);
        
        $models = [];
        $model = [];
        
        foreach($vos as $vo) {
            $model['id'] = $vo->getUser()->getId();
            $model['name'] = $vo->getUser()->getName();
            $model['ship_id'] = $this->ship_id;
            $models[] = $model;
        }
        
        return new ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
    }
    
    public function getAllShips() {
        if(!$this->validate()) {
            return false;
        }
        
        if(UserLibrary::isAdmin($this->user_id)) {
            $vos = $this->shipDao->getAllShips();   
        } else {
            $vos = [];
        }
        $models = [];
        $model = [];
        foreach($vos as $vo) {
            $model['id'] = $vo->getId();
            $model['name'] = $vo->getName();
            $model['description'] = $vo->getDescription();
            $models[] = $model;
        }
        
        return new ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
    }

    public function searchShips($q) {
        if(!$this->validate()) {
            return false;
        }
        
        if(UserLibrary::isAdmin($this->user_id)) {
            return $this->shipDao->searchShips($q);
            
        }
        
        return [];

        
        
    }

}