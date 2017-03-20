<?php

use yii\db\Migration;

class m170307_135846_create_table_access_control extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE access_control(
            id int not null primary key auto_increment,
            code varchar(255) not null unique,
            name varchar(255) not null,
            description text null,
            status smallint(6) not null,
            created_at int not null,
            updated_at int not null
            ) ENGINE=InnoDB");
    }

    public function down()
    {
        echo "m170307_135846_create_table_access_control cannot be reverted.\n";

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
