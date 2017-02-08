<?php

namespace console\controllers;
use Yii;
use yii\console\Controller;
class ActiveController extends Controller {
    
    public $name;
    
    public function options($id) {
        return ['name'];
    }
    
    public function optionAliases() {
        return ['n' => 'name'];
    }
    
    public function actionCreate()
    {
        $dirPath = "common/models/" . $this->name . ".php" ;
        $text = $this->getText($this->name);
        if (file_put_contents($dirPath, $text) !== false) {
        } else {
            echo "Cannot create file";
        }
    }
    
    private function getText($name) {
        $underCase=  $this->convertToDb($name);
        return 
"<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * Tag model
 *
 */
class $name extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%$underCase}}';
    }
    
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


}
";
    }
    
    private function convertToDb($name) {
        $matcher = [];
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $name, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
          $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }
}