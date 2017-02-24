<?php
namespace frontend\services;

use yii\data\ArrayDataProvider;
use common\libraries\UserLibrary;
use common\validators\IsAdminValidator;
use common\models\EntityType;
use common\components\RService;
use frontend\vos\EntityVo;
use frontend\daos\ShipDao;
use frontend\daos\EntityDao;
/**
 * ShipService service
 *
 */
class ShipService extends RService
{
    const GET_ALL_SHIPS = "getallships";
    
    const GET_SHIP_OWNERSHIP = "getshipownership";
    
    const GET_SHIP_INFO = "getshipinfo";
    
    
    //attributes
    public $user_id;
    
    private $shipDao;
    
    public $ship_id;
    
    /**
     *
     * @var /frontend/daos/EntityDao
     */
    private $entityDao;
    
    /**
     *
     * @var int
     */
    private $entityTypeId;
    
    public function init() {
        $this->shipDao = new ShipDao();
        $this->entityDao = new EntityDao();
        $this->entityTypeId = EntityType::getTypeId(EntityType::SHIP);
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['ship_id', 'integer'],
            ['ship_id', 'required', 'on' => [self::GET_SHIP_OWNERSHIP, self::GET_SHIP_INFO] ]
        ];
    }
    
    /**
     * 
     * @return null|EntityVo
     */
    public function getShipInfo() {
        $this->setScenario(self::GET_SHIP_INFO);
        if(!$this->validate()) {
            return null;
        }
        
        return $this->entityDao->getEntityInfoWithType($this->ship_id, 
                    $this->entityTypeId);
    }
    
    /**
     * 
     * @return boolean|ArrayDataProvider
     */
    public function getShipOwnership() {
        $this->setScenario(self::GET_SHIP_OWNERSHIP);
        if(!$this->validate()) {
            return false;
        }
        
        $vos =  $this->entityDao->getEntityOwnership($this->ship_id);
        
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
    
    /**
     * 
     * @return boolean|ArrayDataProvider
     */
    public function getAllShips() {
        if(!$this->validate()) {
            return false;
        }
        
        if(UserLibrary::isAdmin($this->user_id)) {
            $vos = $this->entityDao->getAllEntitiesByType($this->entityTypeId);   
        } else {
            $vos = [];
        }
        $models = [];
        $model = [];
        foreach($vos as $vo) {
            $model['id'] = $vo->getId();
            $model['code'] => $vo->getCode();
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

    /**
     * 
     * @param string $q
     * @return boolean|EntityVo[]
     */
    public function searchShips($q) {
        if(!$this->validate()) {
            return false;
        }
        
        if(UserLibrary::isAdmin($this->user_id)) {
            return $this->entityDao->searchEntitiesByType($q, $this->entityTypeId);
            
        } else if(UserLibrary::isOwner($this->user_id)) {
            return $this->entityDao->searchEntitiesByOwnerAndType($q, $this->user_id, $this->entityTypeId);
        }
        return [];
    }

}