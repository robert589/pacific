<?php
namespace common\widgets;

use yii\base\Widget;

class TabItem extends widget {
    
    public $id;
    
    public $index;
    
    
    public function init() {
        parent::init();
        ob_start();
    }

    public function run() {
        $content = ob_get_clean();
        return $this->render('tab-item', ['id' => $this->id, 
                                          'index' => $this->index,
                                          'content' => $content]);
    }

}
