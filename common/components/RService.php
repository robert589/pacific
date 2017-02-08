<?php 
namespace common\components;
use yii\base\Model;

abstract class RService extends Model {
    public function loadData($data) {
        if(isset($data)) {
            $this->setAttributes($data);
            return true;
        }
        
        return true;
    }
}