<?php

use yii\db\Migration;

class m170205_075243_create_table_owner extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE owner(
            id int not null primary key,
            foreign key(id) references user(id)) ENGINE=InnoDB");
    }

    public function down()
    {
        echo "m170205_075243_create_table_owner cannot be reverted.\n";

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
