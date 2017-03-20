<?php

use yii\db\Migration;

class m170320_051259_add_default_warehouse_to_purchase extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE purchase add warehouse_id int not null, 
                                    add foreign key(warehouse_id) references warehouse(id)");
    }

    public function down()
    {
        echo "m170320_051259_add_default_warehouse_to_purchase cannot be reverted.\n";

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
