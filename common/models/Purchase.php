<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
/**
 * Tag model
 *
 */
class Purchase extends ActiveRecord
{
    
    const STATUS_ACTIVE = 10;
    
    const STATUS_DELETED = 0;
    
    public static function tableName()
    {
        return '{{%purchase}}';
    }
    
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className()
        ];
    }


    public static function getStatus() {
        return 
        [
            self::STATUS_ACTIVE => "active",
            self::STATUS_DELETED => "deleted"
        ];
    }
}
