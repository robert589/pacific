<?php

namespace console\controllers;
use Yii;
use yii\console\Controller;
class DaoController extends Controller {
    
    public $path = "frontend";
    
    /**
     *
     * @var string
     * CamelCase
     * z
     */
    public $name;
        
    public function options($id) {
        return ['name'];
    }
    
    public function optionAliases() {
        return ['n' => 'name', 'p' => 'path'];
    }
    
    public function actionCreate()
    {
        $containerWidget = $this->path . "/daos/" . $this->name . ".php" ;
        $text = $this->getText($this->name);
        if (file_put_contents($containerWidget, $text) !== false) {
        } else {
            echo "Cannot create container widget";
        }
    }
    
    private function getText($name) {
        return 
"<?php
namespace frontend\daos;

use Yii;
use common\components\Dao;
/**
 * $name class
 */
class " . $name . " implements Dao
{
    
}

";
    }
    
    
}