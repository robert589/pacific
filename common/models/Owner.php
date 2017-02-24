<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * Tag model
 *
 */
class Owner extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%owner}}';
    }
    
    const GET_ROLE = "owner";
}
