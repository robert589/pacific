<?php

namespace common\widgets;

use yii\base\Widget;

class DynamicField extends Widget {
    
    public $id;
    
    public $name;
    
    public $newClass;
    
    public function init() {
        parent::init();
        ob_start();
    }

    public function run() {
        $content = ob_get_clean();
        return $this->render('dynamic-field', ['content' => $content, 'newClass' => $this->newClass,
                            'id' => $this->id, 'name' => $this->name]);
    }

}
