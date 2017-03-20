<?php

use yii\db\Migration;

class m170209_185357_create_table_entity_type extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE entity_type(
            id int not null primary key auto_increment,
            name varchar(255) not null,
            description text null,
            created_at int not null,
            updated_at int not null,
            status int not null default 10) ENGINE=InnoDB");

    }

    public function down()
    {
        echo "m170209_185957_create_table_entity_type cannot be reverted.\n";

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
