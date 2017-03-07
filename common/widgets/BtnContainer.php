<?php
namespace common\widgets;
use yii\base\Widget;


class BtnContainer extends Widget {

    public $id;
    
    public $btnText;
   
    public $btnNewClass;
    
    public $color;
    
    public $newClass;
    
    public function init() {
        parent::init();
        ob_start();
    }

    public function run() {
        $content = ob_get_clean();
        return $this->render('btn-container', 
                ['id' => $this->id, 'content' => $content, 
                    'btnNewClass' => $this->btnNewClass,
                    'color' => $this->color,
                    'newClass' => $this->newClass,
                    'btnText' => $this->btnText]);
    }
}