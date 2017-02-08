<?php
namespace common\widgets;

use yii\base\Widget;
/**
 * Not finished
 */
class DropdownField extends Widget {
    
    public $id;
    
    public $name;
    
    public $items;
    
    public $text;
    
    public $index;
    
    public $value;
    
    public $options = [];
   
    public $placeholder;
    
    public $newClass = "";
    
    public function init() {
        
    }
    
    public function run() {
        $stringified = '';
        foreach($this->options as $index => $datum) {
            $stringified .= $index . '=' . $datum . ' ';
        }
    
        return $this->render('dropdown-field', 
                ['id' => $this->id, 'index' => $this->index, 'text' => $this->text,
                    'placeholder' => $this->placeholder, 'value' => $this->value,
                    'newClass' => $this->newClass,
                    'options' => $stringified,
                    'name' => $this->name, 'items' => $this->items]);
    }
}
