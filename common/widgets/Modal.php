<?php
namespace common\widgets;
use yii\base\Widget;


class Modal extends Widget {
    const SIZE_SMALL = "modal-small";
    
    const SIZE_MEDIUM = "modal-medium";
    
    const SIZE_LARGE = "modal-large";
    
    public $id;

    public $title;
    
    public $size;
    
    public $newClass;
    
    public function init() {
        parent::init();
        ob_start();
    }

    public function run() {
        $content = ob_get_clean();
        if($this->size === null) {
            $this->size = self::SIZE_SMALL;
        }
        return $this->render('modal', ['id' => $this->id, 'newClass' => $this->newClass,
            'title' => $this->title, 'content' => $content, 'size' => $this->size]);
    }
}