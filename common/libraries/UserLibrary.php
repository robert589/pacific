<?php
namespace common\libraries;

use common\models\User;
use common\models\Admin;
use frontend\daos\UserDao;
use common\models\Owner;

class UserLibrary {
    
    
    public static function getRole($id = null) {
        $dao = new UserDao();
        if(!$id) {
            $id = \Yii::$app->user->getId();    
        }
        return $dao->getRole($id);
    }
    
    public static function isAdmin($id) {
        return Admin::find()->where(['id' => $id])->exists();
    }
    
    public static function isOwner($id) {
        return Owner::find()->where(['id' => $id])->exists();
    }
    
    public static function generateUsername($firstName, $lastName) {
        $base_username = strtolower($firstName) . '.' . strtolower($lastName);
        $i = 0;
        while(true){

            if($i != 0){
                $update_username = $base_username . '.' . $i;
            }
            else{
                $update_username = $base_username;
            }

            if(User::find()->where(['username' => $update_username])->exists()){
                $i++;
            }
            else{
                //Yii::$app->end($update_username);
                return $update_username;
            }
        }

    }
    
    
}