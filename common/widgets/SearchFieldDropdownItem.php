<?php
namespace common\widgets;

use yii\bootstrap\Widget;

class SearchFieldDropdownItem extends Widget {
    public $id;
    
    public $itemId;
    
    public $text;
        
    public function init() {
        
    }
    
    public function run() {
        return $this->render('search-field-dropdown-item', 
                    ['id' => $this->id, 'text' => $this->text, 'itemId' => $this->itemId]);
    }
}