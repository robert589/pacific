<?php

use yii\db\Migration;

class m170307_124116_create_table_user_role extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE user_role(
            user_id int not null,
            role_id int not null,
            status smallint(6) not null,
            created_at int not null,
            updated_at int not null,
            primary key(user_id, role_id),
            foreign key(user_id) references user(id),
            foreign key(role_id) references role(id)) ENGINE=InnoDB");

    }

    public function down()
    {
        echo "m170307_124116_create_table_user_role cannot be reverted.\n";

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
