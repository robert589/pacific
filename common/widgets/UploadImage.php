<?php
namespace common\widgets;
use yii\base\Widget;

class UploadImage extends Widget {
    public $id;
    
    const DEFAULT_WIDTH = 300;
    
    CONST DEFAULT_HEIGHT = 300;
    
    
    public function init() {
        parent::init();
    }
    
    public function run() {
        return $this->render('upload-image', ['id' => $this->id, 'width' => self::DEFAULT_WIDTH, 'height' => self::DEFAULT_HEIGHT]);
    }
}