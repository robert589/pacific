<?php
namespace common\widgets;
use yii\base\Widget;


class EmptyModal extends Widget {
    
    public $id;

    public $content;
    
    public $title;
    
    public function init() {
        parent::init();
    }

    public function run() {
        
        return $this->render('empty-modal', ['id' => $this->id, 
            'title' => $this->title, 'content' => $this->content]);
    }
}