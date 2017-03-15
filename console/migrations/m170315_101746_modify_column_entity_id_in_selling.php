<?php

use yii\db\Migration;

class m170315_101746_modify_column_entity_id_in_selling extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE selling change entity_id product_id int not null");

    }

    public function down()
    {
        echo "m170315_101746_modify_column_entity_id_in_selling cannot be reverted.\n";

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
