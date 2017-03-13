<?php

use yii\db\Migration;

class m170313_074200_change_table_selling_to_float_to_double extends Migration
{
    public function up()
    {
        
        $this->execute("ALTER TABLE selling modify column price double null, 
                                                modify column tonase double null,
                                                modify column total double null; ");
    

    }

    public function down()
    {
        echo "m170313_074200_change_table_selling_to_float_to_double cannot be reverted.\n";

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
