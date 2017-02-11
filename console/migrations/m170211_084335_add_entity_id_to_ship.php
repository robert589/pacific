<?php

use yii\db\Migration;

class m170211_084335_add_entity_id_to_ship extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE ship add entity_id int null, add foreign key(entity_id) references entity(id);");
    }

    public function down()
    {
        echo "m170211_084335_add_entity_id_to_ship cannot be reverted.\n";

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
