<?php
namespace frontend\models;

use common\components\RModel;
use common\validators\IsAdminValidator;
use common\models\EntityOwner;
/**
 * ChangeEntityOwnerStatusForm model
 *
 */
class ChangeEntityOwnerStatusForm extends RModel
{

    //attributes
    public $user_id;

    public $owner_id;

    public $entity_id;

    public $status;
    
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()],
            
            ['entity_id', 'integer'],
            ['entity_id', 'required'],
            
            ['owner_id', 'integer'],
            ['owner_id', 'required'],
            ['status', 'integer'],
            ['status', 'required']
        ];
    }
    
    public function change() {
        if(!$this->validate()) {
            return false;
        }
        
        $model = $this->getEntityOwner();
        if(!$model) {
            $model = new EntityOwner();
            $model->entity_id = $this->entity_id;
            $model->owner_id = $this->owner_id;
            $model->status = $this->status;
            return $model->save();
        }
        
        if($model->status != $this->status) {
            $model->status = $this->status;
            return $model->update();
        }
        
        return true;
        
    }
    
    
    private function getEntityOwner() {
        return EntityOwner::find()->where(['entity_id' => $this->entity_id, 'owner_id' => $this->owner_id])->one();
    }

}