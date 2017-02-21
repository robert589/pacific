<?php

use yii\db\Migration;

class m170220_090932_entity_ownership extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE entity_owner(
                 entity_id int not null,
                owner_id int not null,
                created_at int not null,
                updated_at int not null,
                status smallint(6) not null,
                primary key(entity_id, owner_id),
                foreign key(entity_id) references entity(id),
                foreign key(owner_id) references owner(id)
            ); ");

    }

    public function down()
    {
        echo "m170220_110932_entity_ownership cannot be reverted.\n";

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
