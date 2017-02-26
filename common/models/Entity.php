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
}
