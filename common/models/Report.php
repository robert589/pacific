<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * Tag model
 *
 */
class Report extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public static function tableName()
    {
        return '{{%report}}';
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


}
