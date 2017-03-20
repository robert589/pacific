<?php

use yii\db\Migration;

class m170209_185644_create_table_entity extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE entity(
            id int not null primary key,
            name varchar(255) not null,
            description text null,
            status int not null default 10,
            type_id int not null,
            created_at int not null,
            updated_at int not null,
            foreign key(type_id) references entity_type(id)
            ) ENGINE=InnoDB");
    }

    public function down()
    {
        echo "m170209_185644_create_table_entity cannot be reverted.\n";

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
