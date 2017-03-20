<?php

use yii\db\Migration;

class m170318_062327_create_table_purchase extends Migration
{
    public function up()
    {
        
        $this->execute("CREATE TABLE purchase(
            id int not null primary key auto_increment,
            entity_id int not null,
            quantity double not null,
            unit_cost double not null,
            expiry_date int not null,
            created_at int not null,
            updated_at int not null,
            created_by int not null,
            updated_by int not null,
            status smallint(6) not null,
            foreign key(created_by) references user(id),
            foreign key(updated_by) references user(id),
            foreign key(entity_id) references entity(id)
            ) ENGINE=InnoDB"
        );
    }

    public function down()
    {
        echo "m170318_062327_create_table_purchase cannot be reverted.\n";

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
