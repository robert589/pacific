<?php

use yii\db\Migration;

class m170308_091754_create_table_role_access_control extends Migration
{
    public function up()
    {

        $this->execute("CREATE TABLE role_access_control(
            role_id int not null,
            access_control_id int not null,
            status smallint(6) not null,
            created_at int not null,
            updated_at int not null,
            primary key(access_control_id, role_id),
            foreign key(access_control_id) references access_control(id),
            foreign key(role_id) references role(id)) ENGINE=InnoDB");
    }

    public function down()
    {
        echo "m170308_091754_create_table_role_access_control cannot be reverted.\n";

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
