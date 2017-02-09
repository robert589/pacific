<?php

use yii\db\Migration;

class m170209_101034_create_table_selling extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE selling(
            id int not null primary key auto_increment,
            ship_id int not null,
            date varchar(100) not null,
            price float null,
            tonase float null,
            total float null,
            created_at int not null,
            updated_at int not null,
            status int not null default 10,
            foreign key(ship_id) references ship(id)
            )");
    }

    public function down()
    {
        echo "m170209_101034_create_table_selling cannot be reverted.\n";

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
