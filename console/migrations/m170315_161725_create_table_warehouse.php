<?php

use yii\db\Migration;

class m170315_161725_create_table_warehouse extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE warehouse(
            id int not null primary key,
            location text null,
            created_at int not null,
            updated_at int not null) ENGINE=InnoDB;");
    }

    public function down()
    {
        echo "m170315_161725_create_table_warehouse cannot be reverted.\n";

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
