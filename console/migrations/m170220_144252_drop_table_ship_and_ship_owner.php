<?php

use yii\db\Migration;

class m170220_144252_drop_table_ship_and_ship_owner extends Migration
{
    public function up()
    {
        $this->execute("DROP TABLE IF EXISTS ship_owner; DROP TABLE IF EXISTS ship");
    }

    public function down()
    {
        echo "m170220_144252_drop_table_ship_and_ship_owner cannot be reverted.\n";

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
