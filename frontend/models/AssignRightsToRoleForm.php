<?php
namespace frontend\models;

use common\components\RModel;
/**
 * AssignRightsToRoleForm model
 *
 */
class AssignRightsToRoleForm extends RModel
{

    //attributes
    public $user_id;

    public $role_id;

    public $access_control_id;

}