<?php
namespace frontend\services;

use common\models\EntityOwner;
use yii\data\ArrayDataProvider;
use frontend\daos\CodeDao;
use frontend\daos\EntityDao;
use common\components\RService;
use common\libraries\UserLibrary;
/**
 * CodeService service
 *
 */
class CodeService extends RService
{
    
    const GET_ENTITY_TYPE_INFO = "getentitytypeinfo";
    
    const GET_ENTITY_INFO_WITH_CHILD = "getentityinfowithchild";
    
    const GET_ENTITY_INFO = "getentityinfo";
    
    const GET_CODE_LIST = "getcodelist";
    
    const GET_CODE_TYPE_LIST = "getcodetypelist";
    
    const GET_SUB_CODE = "getsubcode";
    
    const GET_CODE_INFO_FOR_EDIT = "getcodeinfoforedit";
    
    //attributes
    public $user_id;
    
    public $entity_id;
    
    public $entity_type_id;
    
    private $codeDao;
    
    private $entityDao;
    
    public function init() {
        $this->codeDao = new CodeDao();
        $this->entityDao = new EntityDao();
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', 'checkAC', 'on' => [self::GET_ENTITY_INFO_WITH_CHILD, 
                                            self::GET_SUB_CODE, 
                                            self::GET_ENTITY_INFO,
                                            self::GET_CODE_INFO_FOR_EDIT]],
            
            ['entity_id', 'integer'],
            ['entity_id', 'required', 'on' => [self::GET_ENTITY_INFO_WITH_CHILD, 
                                                self::GET_ENTITY_INFO,
                                                self::GET_SUB_CODE]],
            
            ['entity_type_id', 'integer'],
            ['entity_type_id', 'required', 'on' => [ self::GET_ENTITY_TYPE_INFO
                                                    ]]
        ];
    }
    
    public function getEntityTypeInfo() {
        $this->setScenario(self::GET_ENTITY_TYPE_INFO);
        if(!$this->validate()) {
            return null;
        }
        
        return $this->entityDao->getEntityTypeInfo($this->entity_type_id);
    }
    public function getEntityInfo() {
        $this->setScenario(self::GET_ENTITY_INFO);
        if(!$this->validate()) {
            return null;
        }
        
        return $this->entityDao->getEntityInfoWithRelations($this->entity_id);
    }
    
    public function getEntityInfoForEdit() {
        $this->setScenario(self::GET_CODE_INFO_FOR_EDIT);
        if(!$this->validate()) {
            return null;
        }
        
        return $this->entityDao->getEntityInfoWithRelations($this->entity_id);
    }
    
    public function getSubCode() {
        $this->setScenario(self::GET_SUB_CODE);
        if(!$this->validate()) {
            return false;
        }
        
        $models = [];
        
        $vos = $this->codeDao->getSubcode($this->entity_id);
        foreach($vos  as $vo) {
            $model['code'] = $vo->getCode();
            $model['name'] = $vo->getName();
            $model['id'] = $vo->getId();
            $model['type'] = $vo->getEntityType()->getName();
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
    
    
    public function checkAC() {
        $allowed = EntityOwner::checkAccessControl($this->user_id, $this->entity_id);
        if(!$allowed) {
            return $this->addError('user_id', 'Not allowed');
        }
    }
    
    public function searchType($query) {
        if(!$this->validate()) {
            return false;
        }
        
        return $this->codeDao->searchCodeType($query);
    }

    public function search($query) {
        if(!$this->validate()) {
            return false;
        }
        
        if(UserLibrary::isAdmin($this->user_id)) {
            return $this->codeDao->searchCode($query);   
        } else {
            return $this->codeDao->searchCodeByOwner($query, $this->user_id);
        }
    }
    
    /**
     * 
     * @return EntityVo[]
     */
    public function getEntityInfoWithChild() {
        $this->setScenario(self::GET_ENTITY_INFO_WITH_CHILD);
        if(!$this->validate()) {
            return false;
        }
        
        return $this->entityDao->getEntityInfoWithRelations($this->entity_id);
    }
    
    public function getCodeList() {
        if(!$this->validate()) {
            return false;
        }
        $models = [];
        $model = [];
        $vos = $this->entityDao->getAllEntities(); 
       foreach($vos  as $vo) {
            $model['code'] = $vo->getCode();
            $model['name'] = $vo->getName();
            $model['id'] = $vo->getId();
            $model['current_status'] = $vo->getStatusText();
            $model['status'] = $vo->getStatus();
            $model['active'] = $vo->isActive();
            $model['type'] = $vo->getEntityType()->getName();
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
    
    public function getCodeTypeList() {
        if(!$this->validate()) {
            return false;
        }
        
        $models = [];
        $model = [];
        
        $vos = $this->codeDao->getCodeTypeList();
        foreach($vos  as $vo) {
            $model['id'] = $vo->getId();
            $model['name'] = $vo->getName();
            $model['description'] = $vo->getDescription();
            $model['status'] = $vo->getStatusText();
            $model['active'] = $vo->isActive();
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