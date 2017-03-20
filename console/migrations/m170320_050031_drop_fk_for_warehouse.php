<?php

use yii\db\Migration;

class m170320_050031_drop_fk_for_warehouse extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE warehouse add foreign key(id) references entity(id)");

    }

    public function down()
    {
        echo "m170320_050031_drop_fk_for_warehouse cannot be reverted.\n";

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
