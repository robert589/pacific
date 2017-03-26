<?php
namespace frontend\models;

use common\validators\IsAdminValidator;
use common\models\Entity;
use common\models\Asset;
use common\components\RModel;
use common\models\FixedAsset;
/**
 * AddAssetForm model
 *
 */
class AddAssetForm extends RModel
{

    //attributes
    public $user_id;

    public $code;

    public $name;

    public $description;

    public $type_id;

    public $method;
    
    public $fixed_asset;
    
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()],
            
            ['name', 'string'],
            ['name', 'required'],
            
            ['description', 'string'],
           
            ['type_id', 'integer'],
            ['type_id', 'required'],
            
            ['code', 'integer'],
            ['code', 'required'],
            ['code', 'unique', 'targetClass' => '\common\models\Entity', 'message' => 'This id has already been taken.'],
            
            ['method', 'integer'],
            ['method', 'required'],
            
            ['fixed_asset', 'boolean'],
            ['fixed_asset', 'required']

        ];
    }
    
    public function add() {
        if(!$this->validate()) {
            return false;
        }
        
        $entity = new Entity();
        $entity->code = $this->code;
        $entity->type_id = $this->type_id;
        $entity->name = $this->name;
        $entity->status = Entity::STATUS_ACTIVE;
        $entity->description = $this->description;
        if(!$entity->save()) {
            return null;    
        }
        
        $asset = new Asset();
        $asset->id = $entity->id;
        $asset->method = $this->method;
        
        if(!$asset->save()) {
            return null;
        }
        
        if(!$this->fixed_asset) {
            return true;
        }
        
        $fixedAsset = new FixedAsset();
        $fixedAsset->id = $entity->id;
        if(!$fixedAsset->save()) {
            return null;
        }
        
        return true;
        
        
    }

}