<?php

use yii\db\Migration;

class m170205_080857_create_table_report extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE report(
                            id int not null primary key auto_increment,
                            date varchar(50) not null,
                            ship_id int not null,
                            remark varchar(120) not null,
                            debet float not null default 0,
                            credit float not null default 0,
                            status int not null,
                            foreign key(ship_id) references ship(id))");
    }

    public function down()
    {
        echo "m170205_080857_create_table_report cannot be reverted.\n";

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
