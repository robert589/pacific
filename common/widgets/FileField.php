<?php
namespace common\widgets;

use yii\base\Widget;
class FileField extends Widget {
    
    public $id;
    
    public $name;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('file-field', ['id' => $this->id, 'name' => $this->name]);
    }
}
