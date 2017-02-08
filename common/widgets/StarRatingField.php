<?php
namespace common\widgets;

use yii\bootstrap\Widget;


class StarRatingField extends Field {
    
    public $id;
    
    public $name;
    
    public function init() {
    }
    
    public function run() {
        return $this->render('star-rating-field', ['id' => $this->id, 'name' => $this->name]);
    }
}