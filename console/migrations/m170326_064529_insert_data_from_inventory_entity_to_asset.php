<?php

use yii\db\Migration;

class m170326_064529_insert_data_from_inventory_entity_to_asset extends Migration
{
    public function up()
    {
        $time = time();
        $this->execute("INSERT INTO asset(id, method, created_at, updated_at)
                        SELECT distinct(entity.id), inventory.type, $time, $time
                        FROM entity,inventory
                        where entity.id = inventory.entity_id");

    }

    public function down()
    {
        echo "m170326_064529_insert_data_from_inventory_entity_to_asset cannot be reverted.\n";

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
