<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m161223_061006_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("CREATE TABLE admin(id int not null primary key, foreign key(id) references user(id))");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
