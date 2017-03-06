<?php

use yii\db\Migration;

class m170305_113946_create_table_role extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE role(
            id int not null primary key auto_increment,
            name varchar(255) not null,
            description text null,
            created_at int not null,
            updated_at int not null,
            status int not null)");
    }

    public function down()
    {
        echo "m170305_113946_create_table_role cannot be reverted.\n";

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
