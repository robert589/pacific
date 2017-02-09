<?php

use yii\db\Migration;

class m170209_120020_add_remark_to_selling extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE selling add remark varchar(255) not null");
    }

    public function down()
    {
        echo "m170209_120020_add_remark_to_selling cannot be reverted.\n";

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
