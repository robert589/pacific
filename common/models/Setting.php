<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * Tag model
 *
 */
class Setting extends ActiveRecord
{
    const CURRENT_WAREHOUSE = "currentWarehouse";
            
    public static function tableName()
    {
        return '{{%setting}}';
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
