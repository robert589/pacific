<?php

use yii\db\Migration;

class m170315_103530_add_buyer_id_to_selling_table extends Migration
{
    public function up()
    {
        $this->execute("alter table selling add buyer_id int null, add foreign key(buyer_id) references entity(id);"); 

    }

    public function down()
    {
        echo "m170315_103530_add_buyer_id_to_selling_table cannot be reverted.\n";

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
