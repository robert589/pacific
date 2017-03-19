<?php

use yii\db\Migration;

class m170319_120645_alter_table_purchase_modify_column_expiry_date extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE purchase modify column expiry_date varchar(70) not null");
    }

    public function down()
    {
        echo "m170319_120645_alter_table_purchase_modify_column_expiry_date cannot be reverted.\n";

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
