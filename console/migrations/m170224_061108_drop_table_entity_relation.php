<?php

use yii\db\Migration;

class m170224_061108_drop_table_entity_relation extends Migration
{
    public function up()
    {
        $this->execute("DROP TABLE entity_relation");
    }

    public function down()
    {
        echo "m170224_061108_drop_table_entity_relation cannot be reverted.\n";

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
