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

    public static function add($entityId, $warehouseId, $quantity) {
        return Inventory::updateAllCounters(['quantity' => $quantity], 'warehouse_id=' . intval($warehouseId) .
                                                                            ' AND entity_id=' . intval($entityId));    
    }
    
    public static function remove($entityId, $warehouseId, $quantity) {
        $exist = Inventory::find()->where(['warehouse_id' => intval($warehouseId), 'entity_id' => $entityId])->exists();
        if(!$exist) {
            self::create($entityId, $warehouseId, 0);
        }
        return Inventory::updateAllCounters(['quantity' => -1 * $quantity], 'warehouse_id=' . intval($warehouseId) .
                                                                            ' AND entity_id=' . intval($entityId));    
        
    }
    
    public static function create($entityId, $warehouseId, $quantity) {
        $inventory = new Inventory();
        $inventory->entity_id = $entityId;
        $inventory->warehouse_id = $warehouseId;
        $inventory->quantity = $quantity;
        
//need to delete
        $inventory->fixed_asset= 0;
        $inventory->type = 1;
        $inventory->status = self::STATUS_ACTIVE;
        
        $inventory->save();
    }
}
