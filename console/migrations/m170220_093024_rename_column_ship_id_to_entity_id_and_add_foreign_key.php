<?php

use yii\db\Migration;

class m170220_093024_rename_column_ship_id_to_entity_id_and_add_foreign_key extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE selling change ship_id entity_id int not null, add foreign key(entity_id) references entity(id);");

    }

    public function down()
    {
        echo "m170224_080428_rename_column_ship_id_to_entity_id_and_add_foreign_key cannot be reverted.\n";

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
