<?php

use yii\db\Migration;
use frontend\models\SignupForm;
use common\models\Admin;

class m161223_061324_create_default_admin extends Migration
{
    public function up()
    {
        $model = new SignupForm();
        $model->first_name = "Admin";
        $model->last_name = "Pacific";
        $model->email = "admin.pacific@justgivit.com";
        $model->password = "c";
        $user = $model->signup();
        
        $admin = new Admin();
        $admin->id = $user->id;
        $admin->save();
    }

    public function down()
    {
        echo "m161223_061324_create_default_admin cannot be reverted.\n";

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
