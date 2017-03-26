<?php

use yii\db\Migration;

class m170325_141637_create_table_asset extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE asset(
            id int not null primary key,
            method int not null,
            created_at int not null,
            updated_at int not null,
            foreign key(id) references asset(id))");
    }

    public function down()
    {
        echo "m170325_141637_create_table_asset cannot be reverted.\n";

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
