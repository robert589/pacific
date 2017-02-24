<?php

use yii\db\Migration;

class m170224_065815_rename_column_id_to_code_in_entity extends Migration
{
    public function up()
    {
        $this->execute("alter table entity CHANGE id code int not null");
    }

    public function down()
    {
        echo "m170224_065815_rename_column_id_to_code_in_entity cannot be reverted.\n";

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
