<?php
namespace common\widgets;
use yii\base\Widget;


class ConfirmDialog extends Widget {
    
    public $id;

    public $content;
    
    public $title;
    
    public function init() {
        parent::init();
    }

    public function run() {
        
        return $this->render('confirm-dialog', ['id' => $this->id, 
            'title' => $this->title, 'content' => $this->content]);
    }
}