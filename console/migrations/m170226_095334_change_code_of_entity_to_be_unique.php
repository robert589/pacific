<?php

use yii\db\Migration;

class m170226_095334_change_code_of_entity_to_be_unique extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE entity add unique(code)");
    }

    public function down()
    {
        echo "m170226_095334_change_code_of_entity_to_be_unique cannot be reverted.\n";

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
