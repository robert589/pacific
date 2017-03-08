<?php

namespace console\controllers;
use Yii;
use yii\console\Controller;
use common\models\AccessControl;


class AccessController extends Controller {
    
    public $name;
    
    public function options($id) {
        return ['name'];
    }
    
    public function optionAliases() {
        return ['n' => 'name'];
    }
    
    public function actionUpdate() {
        $myfile = fopen("frontend/web/utils/accesscontrol.txt", "r");
        if ($myfile) {
            $this->removeAllAccessControl();
            while (($line = fgets($myfile)) !== false) {
                $args = explode(";", $line);
                $this->processAccessInfo($args[0], $args[1]);
            }

            fclose($myfile);
        } else {
            echo("Unable to open file!");
            
        } 
        
    }
    
    private function  removeAllAccessControl() {
        return AccessControl::updateAll(["status" => AccessControl::STATUS_DELETED], 'status = ' . AccessControl::STATUS_ACTIVE);
    }


    private function processAccessInfo($code, $name) {
        $accessControl = $this->findAccessControl($code);
        if(!$accessControl) {
            $accessControl = new AccessControl();
            $accessControl->code = $code;
            $accessControl->name = $name;
            $accessControl->status = AccessControl::STATUS_ACTIVE;
            if(!$accessControl->save()) {
                die('Cannot create access control for: ' . $name);
            }
            
            return;
        }
        
        $accessControl->name = $name;
        $accessControl->status = AccessControl::STATUS_ACTIVE;
        if(!$accessControl->update()) {
            die('Cannot update status of access control for : ' . $name);
        }
    }
    
    private function findAccessControl($code) {
        return AccessControl::find()->where(['code' => $code])->one();
    }
    

    
}