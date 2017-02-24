<?php

use yii\db\Migration;

class m170224_065909_add_foreign_key_entity_id_in_transaction extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE transaction add foreign key(entity_id) references entity(id)");

    }

    public function down()
    {
        echo "m170224_082401_add_foreign_key_entity_id_in_transaction cannot be reverted.\n";

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
