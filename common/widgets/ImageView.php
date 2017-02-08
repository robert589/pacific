<?php
namespace common\widgets;
use yii\base\Widget;

class ImageView extends Widget {
    public $id;
    
    public $src;
    
    public $title;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('image-view' ,['id' => $this->id, 'src' => $this->src, 'title' => $this->title]);
    }
}