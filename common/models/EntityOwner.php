<?php
namespace common\models;

use common\libraries\UserLibrary;
use common\models\Admin;
use common\models\Owner;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * Tag model
 *
 */
class EntityOwner extends ActiveRecord
{
    const STATUS_DELETED = '0';
    const STATUS_ACTIVE = '10';
    
    public static function tableName()
    {
        return '{{%entity_owner}}';
    }
    
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    
    public static function checkAccessControl($userId, $entityId) {
        $role = UserLibrary::getRole();
        if($role === Admin::GET_ROLE) {
            return true;
        } 
        else if($role === Owner::GET_ROLE) {
            return EntityOwner::find()->where(['owner_id' => $userId, 'entity_id' => $entityId])->exists();
        }
        
        return false;

    }
}
