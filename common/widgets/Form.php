<?php
namespace common\widgets;

use yii\base\Widget;

class Form extends widget {
    
    /**
     * This is is the same with the child form
     * @var type 
     */
    public $id;
    
    public $method = 'post';
    
    public $widget_class;
    
    public $url;
    
    public $file = false;
    
    public $button_text = 'Submit';
    
    public $enable_button = true;
    
    public function init() {
        parent::init();
        ob_start();
    }

    public function run() {
        $content = ob_get_clean();
        return $this->render('form', ['content' => $content, 'file' => $this->file,
                                    'widget_class' => $this->widget_class, 'enable_button' => $this->enable_button,
                                    'id' => $this->id, 'method' => $this->method, 'url' => $this->url, 'button_text' => $this->button_text]);
    
        
    }

}
