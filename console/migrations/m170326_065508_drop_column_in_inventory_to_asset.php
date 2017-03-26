<?php

use yii\db\Migration;

class m170326_065508_drop_column_in_inventory_to_asset extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE entity drop column in_inventory");

    }

    public function down()
    {
        echo "m170326_065508_drop_column_in_inventory_to_asset cannot be reverted.\n";

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
