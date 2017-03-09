<?php

use yii\db\Migration;

class m170309_062945_drop_owner_id_foreign_key_from_entity_owner extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE entity_owner drop foreign key entity_owner_ibfk_2");
    }

    public function down()
    {
        echo "m170309_062945_drop_owner_id_foreign_key_from_entity_owner cannot be reverted.\n";

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
