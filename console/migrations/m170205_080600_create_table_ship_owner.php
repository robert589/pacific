<?php

use yii\db\Migration;

class m170205_080600_create_table_ship_owner extends Migration
{
    public function up()
    {
        $this->execute("
            CREATE TABLE ship_owner(
                ship_id int not null,
                owner_id int not null,
                created_at int not null,
                updated_at int not null,
                status smallint(6) not null,
                primary key(ship_id, owner_id),
                foreign key(ship_id) references ship(id),
                foreign key(owner_id) references owner(id))");
    }

    public function down()
    {
        echo "m170205_080600_create_table_ship_owner cannot be reverted.\n";

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
