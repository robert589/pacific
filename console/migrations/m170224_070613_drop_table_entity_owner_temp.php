<?php

use yii\db\Migration;

class m170224_070613_drop_table_entity_owner_temp extends Migration
{
    public function up()
    {
        $this->execute("DROP TABLE entity_owner_temp");
    }

    public function down()
    {
        echo "m170224_070613_drop_table_entity_owner_temp cannot be reverted.\n";

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
