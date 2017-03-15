<?php

use yii\db\Migration;

class m170315_194155_add_deletable_to_entity_typ extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE entity_type add deletable boolean not null default 1");
    }

    public function down()
    {
        echo "m170315_194155_add_deletable_to_entity_typ cannot be reverted.\n";

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
