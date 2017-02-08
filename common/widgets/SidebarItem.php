<?php
namespace common\widgets;

use yii\bootstrap\Widget;

class SidebarItem extends Widget {
    public $vo;
    
    public $id;
    
    
    public function init() {
        
    }
    
    public function run() {
        $class = "";
        if($this->vo->isActive()) {
            $class .= "active";
        } 
        return $this->render('sidebar-item', 
                            ['id' => $this->id, 
                            'vo' => $this->vo, 
                            'url' => $this->vo->getUrl(),
                            'class' => $class]);
    }
    
    
}