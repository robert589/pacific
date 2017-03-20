<?php

use yii\db\Migration;

class m170314_122837_create_table_entity_unit extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE entity_selling_unit(
            entity_id int not null primary key,
            unit varchar(255) not null,
            created_at int not null,
            updated_at int not null,
            foreign key(entity_id) references entity(id))ENGINE=InnoDB");
    }

    public function down()
    {
        echo "m170314_122837_create_table_entity_unit cannot be reverted.\n";

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
