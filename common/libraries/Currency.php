<?php
namespace common\libraries;

class Currency {
    
    const US_MONETARY = "en_US";
    
    const ITALIAN_MONETARY = "it_IT";
    
    public static function parse($number, $type = self::US_MONETARY) {
        setlocale(LC_MONETARY, $type);
        return number_format($number, 2) . "\n";
            
    }
}
