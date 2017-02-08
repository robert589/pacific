<?php
namespace common\widgets;

use yii\base\Widget;
/**
 * Not finished
 */
class RadioField extends Widget {
    
    public $id;
    
    public $name;
    
    public $items;
    
    public $value;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('radio-field', 
                ['id' => $this->id, 'value' => $this->value,
                    'name' => $this->name, 'items' => $this->items]);
    }
}
