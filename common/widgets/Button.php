<?php 

namespace common\widgets;

use Yii;

class Button extends \yii\bootstrap\Widget
{
    
    const BLUE_COLOR = "button-blue";
    
    const ORANGE_COLOR = "button-orange";
    
    const GRAY_COLOR  = "button-gray";
    
    const NONE_COLOR = "button-none";
    
    const RED_COLOR = "button-red";
    
    public $id;
    
    public $text;
    
    public $color;
    
    public $widgetClass = "button";
    
    public $newClass = '';
    
    public $icon;
    
    public $options = '';

    public $disabled = false;
    
    public function init()
    {
        parent::init();
        if($this->color === NULL) {
            $this->color = self::BLUE_COLOR;
        }
        
        if(!$this->options) {
            $this->options = [];   
        }

    }
    
    public function run() {
        $class = $this->widgetClass . ' ' . $this->color . ' ' . $this->newClass;
        $iconClass = '';
        if($this->icon !== null) {
            $iconClass = "glyphicon glyphicon-" . $this->icon;
        }
        
        $optionText = "";
        foreach($this->options as $index => $option) {
            $optionText .= "$index=$option ";
        }
        return $this->render('button', ['id' => $this->id, 'iconClass' => $iconClass,
                                        'disabled' => $this->disabled,
                                        'text' => $this->text, 'class' => $class, 'optionText' => $optionText]);
    }
}
