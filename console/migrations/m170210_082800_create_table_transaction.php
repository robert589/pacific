<?php

use yii\db\Migration;

class m170210_082800_create_table_transaction extends Migration
{
    public function up()
    {
        $this->execute("Create table transaction(
            id int not null primary key auto_increment,
            date varchar(120) not null,
            entity_id int not null,
            debet float not null,
            credit float not null,
            remark text null,
            status int not null default 10,
            created_at int not null,
            updated_at int not null
            ) ENGINE=InnoDB");
    }

    public function down()
    {
        echo "m170210_082800_create_table_transaction cannot be reverted.\n";

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
