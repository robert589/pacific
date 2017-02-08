<?php
namespace common\components;

use yii\base\Model;
use common\libraries\CommonLibrary;

abstract class RVoBuilder extends Model{
    
    public function loadData($data, $pre = "") {
        $newData = [];
        
        if($pre !== "") {
            foreach($data as $index => $datum) {
                if(strpos($index, $pre) !== false) {
                    $index = str_replace($pre . "_", "", $index);
                    $newData[$index] = $datum;
                }
            }
            $data = $newData;
        }
        
        if(isset($data)) {
            $data = $this->generalizeDataForm($data);

            $this->setAttributes($data);
        }
        return true;
    }
    
    private function generalizeDataForm($data) {
        $newData = [];
        foreach($data as $index => $datum) {
            if(strpos($index, "_") !== false) {
                $newIndex = CommonLibrary::underscoreToCamelCase($index);   

            } else {
                $newIndex = $index;
            }
            
            $newData[$newIndex] = $datum;
        }
        
        return $newData;
    }
    
    abstract function build();
    
}               