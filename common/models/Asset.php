<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * Tag model
 *
 */
class Asset extends ActiveRecord
{
    
    const FIFO_TYPE = 1;
    
    const LIFO_TYPE = 2;   
    
    public static function tableName()
    {
        return '{{%asset}}';
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


    public static function getTypes() {
        return [
            self::FIFO_TYPE => "FIFO",
            self::LIFO_TYPE => "LIFO"
        ];
    }
}
