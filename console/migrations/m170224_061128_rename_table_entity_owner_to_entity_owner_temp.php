<?php

use yii\db\Migration;

class m170224_061128_rename_table_entity_owner_to_entity_owner_temp extends Migration
{
    public function up()
    {
        $this->execute("RENAME TABLE entity_owner to entity_owner_temp");
    }

    public function down()
    {
        echo "m170224_061128_rename_table_entity_owner_to_entity_owner_temp cannot be reverted.\n";

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
