<?php
namespace frontend\models;

use common\validators\IsAdminValidator;
use common\components\RModel;
use common\validators\DateValidator;
use common\models\Purchase;
use common\models\Inventory;
use common\models\Entity;
/**
 * AddPurchaseForm model
 *
 */
class AddPurchaseForm extends RModel
{

    //attributes
    public $user_id;

    public $entity_id;

    public $quantity;

    public $unit_cost;

    public $expiry_date;

    public $date;
    
    private $inventory;
    
    private $entity;
    
    public function init() {
        
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', IsAdminValidator::className()],
            
            ['entity_id', 'integer'],
            ['entity_id', 'required'],
            ['entity_id', 'inInventory'],
            
            ['quantity', 'integer'],
            ['quantity', 'required'],
            
            ['date', 'string'],
            ['date', 'required'],
            ['date', DateValidator::className()],
            
            ['unit_cost', 'double'],
            ['unit_cost', 'required'],
            
            ['expiry_date', 'string'],
            ['expiry_date', 'required'],
            ['expiry_date', DateValidator::className()]
            
        ];
    }
    
    public function inInventory() {
        $this->entity = Entity::find()->where(['id' => $this->entity_id, 'status' => Entity::STATUS_ACTIVE])->one();
        if(!$this->entity) {
            $this->addError('entity_id', 'Not an entity!');
            return;
        }
        
        if(!boolval($this->entity->in_inventory)) {
            $this->addError('entity_id', 'Not an inventory type!');
            return;
        }
        
        $this->inventory = Inventory::find()->where(['entity_id' => $this->entity_id, 'status' => Inventory::STATUS_ACTIVE])->one();
        
        if(!$this->inventory) {
            $this->inventory = new Inventory();
            $this->inventory->entity_id = $this->entity_id;
            $this->inventory->fixed_asset = 0;
            $this->inventory->quantity = 0;
            $this->inventory->status = Inventory::STATUS_ACTIVE;
            $this->inventory->type = Inventory::FIFO_TYPE;
            if(!$this->inventory->save()) {
                $this->addError('entity_id', 'Inventory cannot be created!');
            }
        }
    }
    
    public function add() {
        if(!$this->validate()) {
            return null;
        }
        
        $purchase = new Purchase();
        $purchase->entity_id = $this->entity_id;
        $purchase->quantity = $this->quantity;
        $purchase->unit_cost = $this->unit_cost;
        $purchase->date = $this->date;
        $purchase->expiry_date = $this->expiry_date;
        $purchase->status = Purchase::STATUS_ACTIVE;
        if(!$purchase->save()) {
            return null;
        }
        
        return Inventory::add($this->entity_id, $this->quantity);
        
    }
}