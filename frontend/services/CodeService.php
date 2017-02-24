<?php
namespace frontend\services;

use common\models\EntityOwner;
use yii\data\ArrayDataProvider;
use frontend\daos\CodeDao;
use frontend\daos\EntityDao;
use common\components\RService;
/**
 * CodeService service
 *
 */
class CodeService extends RService
{
    
    const GET_ENTITY_INFO_WITH_CHILD = "getentityinfowithchild";
    
    
    const GET_CODE_LIST = "getcodelist";
    
    const GET_CODE_TYPE_LIST = "getcodetypelist";
    
    const GET_SUB_CODE = "getsubcode";
    
    //attributes
    public $user_id;
    
    public $entity_id;
    
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
            ['user_id', 'checkAC', 'on' => [self::GET_ENTITY_INFO_WITH_CHILD, self::GET_SUB_CODE]],
            
            ['entity_id', 'integer'],
            ['entity_id', 'required', 'on' => [self::GET_ENTITY_INFO_WITH_CHILD, self::GET_SUB_CODE]]
        ];
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
        
        return $this->codeDao->searchCode($query);
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