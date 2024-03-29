<?php

use yii\db\Migration;

class m170309_063005_add_user_id_to_entity_owner extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE entity_owner add foreign key(owner_id) references user(id)");
    }

    public function down()
    {
        echo "m170309_063005_add_user_id_to_entity_owner cannot be reverted.\n";

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
