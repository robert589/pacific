<?php

use yii\db\Migration;

class m170224_062509_drop_primary_key_entity extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE entity drop primary key");
    }

    public function down()
    {
        echo "m170224_062509_drop_primary_key_entity cannot be reverted.\n";

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
