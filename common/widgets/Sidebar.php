<?php

namespace common\widgets;

use yii\bootstrap\Widget;

class Sidebar extends Widget {
    
    /**
     *
     * @var type string 
     */
    public $id;
    
    /**
     *
     * @var type SidebarVo[] 
     */
    public $vos = [];
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('sidebar', ['vos' => $this->vos, 'id' => $this->id]);
    }
    
}