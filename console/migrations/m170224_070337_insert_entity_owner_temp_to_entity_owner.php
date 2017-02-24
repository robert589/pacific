<?php

use yii\db\Migration;

class m170224_070337_insert_entity_owner_temp_to_entity_owner extends Migration
{
    public function up()
    {
        $this->execute("
            INSERT INTO entity_owner(entity_id,owner_id,created_at,updated_at,status)
            SELECT entity.id, entity_owner_temp.owner_id, entity_owner_temp.created_at, entity_owner_temp.updated_at, entity_owner_temp.status
            from entity_owner_temp,entity
            where entity_owner_temp.entity_id = entity.code
            ");
    }

    public function down()
    {
        echo "m170224_070337_insert_entity_owner_temp_to_entity_owner cannot be reverted.\n";

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
