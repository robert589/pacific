<?php

use yii\db\Migration;

class m170221_123334_add_entity_relation extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE entity_relation(
                parent_entity_id int not null,
                child_entity_id int not null,
                status smallint(6) not null,
                created_at int not null,
                updated_at int not null,
                primary key(parent_entity_id, child_entity_id),
                foreign key(parent_entity_id) references entity(id),
                foreign key(child_entity_id) references entity(id)
        )");

    }

    public function down()
    {
        echo "m170221_123334_add_entity_relation cannot be reverted.\n";

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
