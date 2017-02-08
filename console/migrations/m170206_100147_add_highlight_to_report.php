<?php

use yii\db\Migration;

class m170206_100147_add_highlight_to_report extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE report add highlight boolean not null default 0");
    }

    public function down()
    {
        echo "m170206_100147_add_highlight_to_report cannot be reverted.\n";

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
