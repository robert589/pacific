<?php
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {   
        $this->execute("  SET GLOBAL FOREIGN_KEY_CHECKS = 1;");
        $this->execute("SET GLOBAL default_storage_engine=InnoDB;");
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->execute("
            CREATE TABLE `user` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
              `status` smallint(6) NOT NULL DEFAULT '10',
              `created_at` int(11) NOT NULL,
              `updated_at` int(11) NOT NULL,
              telephone varchar(100) null,
              address varchar(100) null,
              `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
              `profile_pic` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.png',
              PRIMARY KEY (`id`),
              UNIQUE KEY `username` (`username`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

            -- --------------------------------------------------------

            --
            -- Table structure for table `user_email_authentication`
            --

            CREATE TABLE IF NOT EXISTS `user_email_authentication` (
              `user_id` int(11) NOT NULL,
              `password_hash` varchar(255) NOT NULL,
              `password_reset_token` varchar(255) NOT NULL,
              `primary_email` tinyint(1) NOT NULL DEFAULT '1',
              `email` varchar(100) NOT NULL,
              `validated` tinyint(1) NOT NULL DEFAULT '0',
              `created_at` int(11) NOT NULL,
              `updated_at` int(11) NOT NULL,
              foreign key(user_id) references user(id),
              PRIMARY KEY (`user_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
