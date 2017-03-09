<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `owner`.
 */
class m170309_062955_drop_owner_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropTable('owner');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->createTable('owner', [
            'id' => $this->primaryKey(),
        ]);
    }
}
