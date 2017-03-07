<?php
namespace common\widgets;
use yii\base\Widget;


class BtnContainer extends Widget {

    public $id;
    
    public $btnText;
   
    public function init() {
        parent::init();
        ob_start();
    }

    public function run() {
        $content = ob_get_clean();
        return $this->render('btn-container', 
                ['id' => $this->id, 'content' => $content, 'btnText' => $this->btnText]);
    }
}