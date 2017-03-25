<?php

use yii\db\Migration;

class m170325_063719_add_warehouse_to_selling_table extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE selling add warehouse_id int null, 
                                            add foreign key(warehouse_id) references warehouse(id);");

    }

    public function down()
    {
        echo "m170325_063719_add_warehouse_to_selling_table cannot be reverted.\n";

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
