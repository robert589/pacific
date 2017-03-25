<?php

use yii\db\Migration;

class m170325_064538_change_column_name_of_tonase_to_unit_in_selling_table extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE selling change tonase unit double not null");
    }

    public function down()
    {
        echo "m170325_064538_change_column_name_of_tonase_to_unit_in_selling_table cannot be reverted.\n";

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
