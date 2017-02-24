<?php

use yii\db\Migration;

class m170224_061208_drop_foreign_key_in_selling extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE selling drop foreign key selling_ibfk_1");
    }

    public function down()
    {
        echo "m170224_081927_drop_foreign_key_in_selling cannot be reverted.\n";

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
