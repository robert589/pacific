<?php

use yii\db\Migration;

class m170224_065907_add_id_auto_increment_to_entity extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE entity add id int not null primary key auto_increment");
    }

    public function down()
    {
        echo "m170224_065907_add_id_auto_increment_to_entity cannot be reverted.\n";

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
