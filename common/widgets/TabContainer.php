<?php
namespace common\widgets;

use yii\base\Widget;

class TabContainer extends widget {
    
    public $id;
    
    public $tabItems;
    
    public $activeIndex;
    
    public function init() {
        parent::init();
        ob_start();
    }

    public function run() {
        $content = ob_get_clean();
        
        return $this->render('tab-container', ['id' => $this->id, 
                                            'content' => $content,
                                            'activeIndex' => $this->activeIndex,
                                            'tabItems' => $this->tabItems]);
    }
}
