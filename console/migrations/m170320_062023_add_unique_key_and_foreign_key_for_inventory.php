<?php

use yii\db\Migration;

class m170320_062023_add_unique_key_and_foreign_key_for_inventory extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE inventory add foreign key(entity_id) references entity(id), 
                                            add unique(entity_id, warehouse_id);");
    }

    public function down()
    {
        echo "m170320_062023_add_unique_key_and_foreign_key_for_inventory cannot be reverted.\n";

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
