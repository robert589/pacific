<?php

use yii\db\Migration;

class m170313_074009_change_table_transaction_to_float_to_double extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE transaction modify column debet double not null, 
                                                modify column credit double not null; ");
    }

    public function down()
    {
        echo "m170313_074009_change_table_transaction_to_float_to_double cannot be reverted.\n";

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
