<?php
namespace frontend\services;

use yii\data\ArrayDataProvider;
use frontend\daos\CodeDao;
use common\components\RService;
/**
 * CodeService service
 *
 */
class CodeService extends RService
{
    
    const GET_CODE_LIST = "getcodelist";
    
    const GET_CODE_TYPE_LIST = "getcodetypelist";
    
    //attributes
    public $user_id;
    
    private $codeDao;
    
    public function init() {
        $this->codeDao = new CodeDao();
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required']
        ];
    }
    
    public function getCodeList() {
        if(!$this->validate()) {
            return false;
        }
        
        $models = [];
        $model = [];
        
        $vos = $this->codeDao->getCodeList();
        foreach($vos  as $vo) {
            $model['code'] = $vo->getId();
            $model['name'] = $vo->getName();
            $model['description'] = $vo->getDescription();
            $model['type'] = $vo->getEntityType()->getName();
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