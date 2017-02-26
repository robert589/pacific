<?php

use yii\db\Migration;

class m170226_062916_change_code_of_entity_to_be_nullable extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE entity modify column code int null");
    }

    public function down()
    {
        echo "m170226_062916_change_code_of_entity_to_be_nullable cannot be reverted.\n";

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
