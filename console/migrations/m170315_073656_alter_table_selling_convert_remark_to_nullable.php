<?php

use yii\db\Migration;

class m170315_073656_alter_table_selling_convert_remark_to_nullable extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE selling modify column remark text null");
    }

    public function down()
    {
        echo "m170315_073656_alter_table_selling_convert_remark_to_nullable cannot be reverted.\n";

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
