<?php
namespace frontend\models;

use common\components\RModel;
/**
 * ChangePasswordForm model
 *
 */
class ChangePasswordForm extends RModel
{

    //attributes
    public $user_id;

    public $old_password;

    public $new_password;

}