<?php

use yii\db\Migration;

class m170220_093025_drop_table_report extends Migration
{
    public function up()
    {
        $this->execute("DROP TABLE report");

    }

    public function down()
    {
        echo "m170224_080818_drop_table_report cannot be reverted.\n";

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
