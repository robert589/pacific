<?php

use yii\db\Migration;

class m170320_061655_drop_unique_key_entity_id_from_inventory extends Migration
{
    public function up()
    {
        $this->execute("alter table inventory drop foreign key inventory_ibfk_1, drop index entity_id");
    }

    public function down()
    {
        echo "m170320_061655_drop_unique_key_entity_id_from_inventory cannot be reverted.\n";

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
