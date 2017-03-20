<?php

use yii\db\Migration;

class m170318_100442_create_table_inventory extends Migration
{
    public function up()
    {
        
        $this->execute("CREATE TABLE inventory(
            id int not null primary key auto_increment,
            entity_id int not null unique,
            quantity double not null,
            fixed_asset boolean not null,
            type smallint(6) not null,
            created_at int not null,
            updated_at int not null,
            status smallint(6) not null,
            foreign key(entity_id) references entity(id)
            ) ENGINE=InnoDB"
        );

    }

    public function down()
    {
        echo "m170318_100442_create_table_inventory cannot be reverted.\n";

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
