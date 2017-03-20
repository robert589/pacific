<?php

use yii\db\Migration;

class m170320_060653_add_warehouse_id_to_inventory extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE inventory add warehouse_id int not null, add foreign key(warehouse_id) references warehouse(id);");
    }

    public function down()
    {
        echo "m170320_060653_add_warehouse_id_to_inventory cannot be reverted.\n";

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
