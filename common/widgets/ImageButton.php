<?php
namespace common\widgets;
use yii\base\Widget;

class ImageButton extends Widget {
    public $id;
    
    public $src;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('image-button' ,['id' => $this->id, 'src' => $this->src]);
    }
}