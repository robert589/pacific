<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * Tag model
 *
 */
class EntityType extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    
    /**
     * Has to be the same with db
     */
    const SHIP = "Kapal";
    
    public static function tableName()
    {
        return '{{%entity_type}}';
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

    /**
     * 
     * @param string $text
     * @return int
     */
    public static function getTypeId($text) {
        return self::find()->where(['name' => $text])->one()['id'];
    }
    
    public static function getStatus() {
        return [
            self::STATUS_ACTIVE => "Active",
            self::STATUS_DELETED => "Removed"
        ];
    }

}
