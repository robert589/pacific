<?php

use yii\db\Migration;

class m170319_101856_alter_table_purchase_add_date extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE purchase add date varchar(70) not null");
    }

    public function down()
    {
        echo "m170319_101856_alter_table_purchase_add_date cannot be reverted.\n";

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
