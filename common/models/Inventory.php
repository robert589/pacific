<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * Tag model
 *
 */
class Inventory extends ActiveRecord
{
    const STATUS_ACTIVE = 10;
    
    const STATUS_DELETED = 0;
    
    const FIFO_TYPE = 1;
    
    const LIFO_TYPE = 2;    
    
    public static function tableName()
    {
        return '{{%inventory}}';
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
        return 
        [
            self::STATUS_ACTIVE => "active",
            self::STATUS_DELETED => "deleted"
        ];
    }
    
    public static function getType() {
        return [
            self::FIFO_TYPE => "FIFO",
            self::LIFO_TYPE => "LIFO"
        ];
    }

    public static function add($entityId, $quantity) {
        return Inventory::updateAllCounters(['quantity' => $quantity], 'entity_id=' . intval($entityId));    
    }
    
    public static function remove($entityId, $quantity) {
        return Inventory::updateAllCounters(['quantity' => -1 * $quantity], 'entity_id=' . intval($entityId));    
        
    }
}
