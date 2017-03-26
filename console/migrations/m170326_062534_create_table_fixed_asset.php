<?php

use yii\db\Migration;

class m170326_062534_create_table_fixed_asset extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE fixed_asset(
            id int not null primary key,
            created_at int not null,
            updated_at int not null,
            foreign key(id) references asset(id))");
    }

    public function down()
    {
        echo "m170326_062534_create_table_fixed_asset cannot be reverted.\n";

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
