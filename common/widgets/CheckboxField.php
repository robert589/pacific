<?php
namespace common\widgets;

use yii\base\Widget;
/**
 * Not finished
 */
class CheckboxField extends Widget {
    
    public $id;
    
    public $name;
    
    public $checked;
    
    public $item;
    
    public function init() {
        
    }
    
    public function run() {
        $checkText = "";
        if($this->checked == 1) {
            $checkText = "checked";
        }
        return $this->render('checkbox-field', 
                ['id' => $this->id, 'checkText' => $checkText,
                    'name' => $this->name, 'item' => $this->item]);
    }
}
