<?php

use yii\db\Migration;

class m170224_065908_add_foreign_key_entity_id_in_selling extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE selling add foreign key(entity_id) references entity(id)");

    }

    public function down()
    {
        echo "m170224_082142_add_foreign_key_entity_id_in_selling cannot be reverted.\n";

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
