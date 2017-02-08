<?php
namespace common\widgets;

use yii\base\Widget;
class SearchField extends Widget {
    
    public $id;
    
    public $url;
    
    public $placeholder;
    
    public $disabled = null;
    
    public $name;
    
    public $newClass;
    
    public $value;
    
    public $index;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('search-field', [
            'id' => $this->id, 'url' => $this->url, 'newClass' => $this->newClass, 'value' => $this->value, 'index' => $this->index,
            'type' => 'text', 'placeholder' => $this->placeholder, 'name' => $this->name, 'disabled' => $this->disabled]);
    }
}
