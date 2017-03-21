<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * Tag model
 *
 */
class Entity extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    
    
    public static function tableName()
    {
        return '{{%entity}}';
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

    public static function getStatus() {
        return [
            self::STATUS_ACTIVE => "Active",
            self::STATUS_DELETED => "Removed"
        ];
    }
    
    public static function getDuplicateEntityName($entityId, $newCode ) {
        $entity = self::find()->where(['id' => $entityId, 'status' => self::STATUS_ACTIVE])->one();
        
        if(!$entity) {
            return null;
        }
        if(intval($entity->code) === intval($newCode)) {
            return null;
        }
        $duplicationEntity = Entity::find()->where(['code' => $this->code])->one();
        if($duplicationEntity) {
            return $duplicationEntity->name;
        }
        
        return null;
    }
}
