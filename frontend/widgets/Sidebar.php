<?php
namespace frontend\widgets;
use yii\base\Widget;

class Sidebar extends Widget {
    
    public $id;
    
    public $items;
    
    public function init() {
        
    }
    
    public function run() {
        
        return $this->render('sidebar', 
                ['id' => $this->id, 'items' => $this->items]);
    }
}