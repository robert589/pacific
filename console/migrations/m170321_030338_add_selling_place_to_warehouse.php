<?php

use yii\db\Migration;

class m170321_030338_add_selling_place_to_warehouse extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE warehouse add selling_place boolean not null default 0");
    }

    public function down()
    {
        echo "m170321_030338_add_selling_place_to_warehouse cannot be reverted.\n";

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
