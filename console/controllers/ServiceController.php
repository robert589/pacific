<?php

namespace console\controllers;
use Yii;
use yii\console\Controller;
class ServiceController extends Controller {
    
    public $name;
    
    public $attrs;
    
    public function options($id) {
        return ['name', 'attrs'];
    }
    
    public function optionAliases() {
        return ['n' => 'name', 'a' => 'attrs'];
    }
    
    public function actionCreate()
    {
        $dirPath = "frontend/services/" . $this->name . ".php" ;
        $attributes = explode(",", $this->attrs);
        
        $text = $this->getHeaderText($this->name);
        $text .= $this->generateAttrs($attributes);
        $text .= $this->getFooterText();
        if (file_put_contents($dirPath, $text) !== false) {
        } else {
            echo "Cannot create file";
        }
    }
    
    private function generateAttrs($attrs) {
        $text = "    //attributes"
                . "\n";
        foreach($attrs as $attr) {
            $text .= "    public $" . $attr  . ";\n\n";
                    
        }
            
        return $text;
        
    }
    
    private function getHeaderText($name) {
        return 
"<?php
namespace frontend\services;

use common\components\RService;
/**
 * $name service
 *
 */
class $name extends RService
{

";
    }
    
    
    private function getFooterText() {
        return "}";
    }
}