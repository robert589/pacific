<?php
namespace common\caches;

use Yii;
use common\models\Setting;

class SettingCache {
    
    private $folderName;
    
    private $memcache;
    
    public function __construct() {
        $this->folderName = Yii::getAlias("@folderName");
        $this->memcache = Yii::$app->cache2;
        
    }
    
    /**
     * 
     * @param string $key
     * @param string $value
     */
    public function set($key, $value) {
        $this->memcache->set($key, $value);
    }
    
    /**
     * 
     * @param string $key
     * @return string
     */
    public static function get($key) {
        $settingCache = new SettingCache();
        return $settingCache->getCache($key);
    }
    
    public function getCache($key) {
        $value = $this->memcache->get($key);
        
        if(!$value) {
            $setting = Setting::find()->where(['name' => $key])->one(); 
            if(!$setting) {
                $value = $setting['value'];
            }
            $this->set($key, $value);
        } else {
            die($value);
        } 
            
        
        return $value;
    }
}