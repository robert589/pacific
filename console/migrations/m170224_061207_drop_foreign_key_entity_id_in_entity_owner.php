<?php

use yii\db\Migration;

class m170224_061207_drop_foreign_key_entity_id_in_entity_owner extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE entity_owner_temp drop foreign key entity_id");
    }

    public function down()
    {
        echo "m170224_061207_drop_foreign_key_entity_id_in_entity_owner cannot be reverted.\n";

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
