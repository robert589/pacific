<?php

use yii\db\Migration;

class m170322_064912_create_table_setting extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE setting(
            id int not null primary key auto_increment,
            name varchar(255) not null unique,
            value varchar(255) null,
            created_at int not null,
            updated_at int not null)");

    }

    public function down()
    {
        echo "m170322_064912_create_table_setting cannot be reverted.\n";

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
