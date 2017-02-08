<?php
namespace common\widgets;
use yii\bootstrap\Widget;

class InfScroll extends Widget {
    public $id;
    
    public $widget_class;
    
    public $total;
    
    public $url;
    
    public $scrollValue;
    
    public $data = [];
    
    public function init() {
        parent::init();
        ob_start();
    }
    
    public function run() {
    
        $content = ob_get_clean();    

        return $this->render('inf-scroll', 
                    ['id' => $this->id, 
                    'content' => $content, 
                    'widget_class' => $this->widget_class,
                    'url' => $this->url,
                    'additionalData' => $this->getStringifyData(),
                    'scrollValue' => $this->scrollValue,
                    'total' => $this->total]);
    }
    
    private function getStringifyData() {
        $stringified = '';
        foreach($this->data as $index => $datum) {
            $stringified .= $index . '=' . $datum . ' ';
        }
        
        return $stringified;
    }
    
}