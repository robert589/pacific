<?php

use yii\db\Migration;

class m170220_093023_drop_foreign_key_of_selling extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE selling drop foreign key selling_ibfk_1");
    }

    public function down()
    {
        echo "m170224_075759_drop_primary_key_of_selling cannot be reverted.\n";

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
