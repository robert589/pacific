<?php

use yii\db\Migration;
use frontend\constants\Constants;
use common\models\EntityType;

class m170315_194620_add_warehouse_to_entity_type extends Migration
{
    public function up()
    {
        $entityType = new EntityType();
        $entityType->name = Constants::ENTITY_TYPE_WAREHOUSE_NAME;
        $entityType->deletable = 1;
        $entityType->save();
    }

    public function down()
    {
        echo "m170315_194620_add_warehouse_to_entity_type cannot be reverted.\n";

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
