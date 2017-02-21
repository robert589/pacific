<?php
use common\models\EntityType;
use common\models\Entity;
use yii\db\Migration;
use frontend\vos\ShipVo;
use frontend\daos\ShipDao;
use common\models\EntityOwner;

class m170220_093022_insert_all_ships_to_entity extends Migration
{   
    
    private $shipDao;
    
    public function init() {
        $this->shipDao = new ShipDao();
    }
    
    public function up()
    {
        $entityType = EntityType::find()->where(['name' => 'Kapal'])->one();
        
        if(!$entityType) {
            $entityType = $this->createShipEntityType();
        }
        $ships = $this->shipDao->getAllShips();
        
        foreach($ships as $ship) {
            $entity = new Entity();
            $entity->type_id = $entityType->id;
            $entity->id = $this->maxcode() + 1;
            $entity->name = $ship->getName();
            $entity->description = $ship->getDescription();
            $entity->status = $ship->getStatus();
            
            $entity->save();
            foreach($ship->getOwners() as $owner) {
                $entityOwner = new EntityOwner();
                $entityOwner->owner_id = $owner->getUser()->getId();
                $entityOwner->status = EntityOwner::STATUS_ACTIVE;
                $entityOwner->entity_id = $entity->id;
                $entityOwner->save();
            }
        }
    }
    
    /**
     * 
     * @return int
     */
    private function maxcode() {
        return $this->shipDao->getHighestCode();
    }
    
    /**
     * 
     * @return EntityType
     */
    private function createShipEntityType() {
        $entityType = new EntityType();
        $entityType->name = 'Kapal';
        $entityType->description = '';
        
        return ($entityType->save()) ? $entityType : null;
    }
    
    
    public function down()
    {
        echo "m170220_093022_insert_all_ships_to_entity cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
