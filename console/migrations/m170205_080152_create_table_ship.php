<?php

use yii\db\Migration;

class m170205_080152_create_table_ship extends Migration
{
    public function up()
    {
        $this->execute("
            CREATE TABLE ship(
                id int not null primary key auto_increment,
                name varchar(100) not null,
                description text null,
                created_at int not null,
                updated_at int not null,
                status smallint(6) not null
        )");
    }

    public function down()
    {
        echo "m170205_080152_create_table_ship cannot be reverted.\n";

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
