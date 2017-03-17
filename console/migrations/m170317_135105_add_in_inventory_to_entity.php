<?php

use yii\db\Migration;

class m170317_135105_add_in_inventory_to_entity extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE entity add in_inventory boolean not null default 0");
    }

    public function down()
    {
        echo "m170317_135105_add_in_inventory_to_entity cannot be reverted.\n";

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
