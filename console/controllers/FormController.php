<?php

namespace console\controllers;
use Yii;
use yii\console\Controller;
class FormController extends Controller {
    
    public $path = "frontend";
    
    /**
     *
     * @var string
     * CamelCase
     * z
     */
    public $name;
        
    public function options($id) {
        return ['name'];
    }
    
    public function optionAliases() {
        return ['n' => 'name', 'p' => 'path'];
    }
    
    public function actionCreate()
    {
        $containerWidget = $this->path . "/widgets/" . $this->name . ".php" ;
        $text = $this->getContainerWidget($this->name);
        if (file_put_contents($containerWidget, $text) !== false) {
        } else {
            echo "Cannot create container widget";
        }
        
        $viewWidget = $this->path . "/widgets/views/" . $this->fromCamelCase($this->name) . ".php"; 
        $text = $this->getViewWidget();
        if (file_put_contents($viewWidget, $text) !== false) {
        } else {
            echo "Cannot create view widget";
        }
        
        $jsWidget = $this->path . "/web/js/project/" . $this->fromCamelCase($this->name) . ".ts";
        $text = $this->getJsWidgetText($this->name);
        if (file_put_contents($jsWidget, $text) !== false) {
        } else {
            echo "Cannot create TypeScript widget";
        }
    }
        
    private function fromCamelCase($camelCase) {
        $matches = [];
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $camelCase, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
          $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('-', $ret);
    }
    
    private function getViewWidget() {
        return "<?php";
    }
    
    private function getJsWidgetText($name) {
        return 
"import {Form} from '../common/form';


export class $name extends Form{

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        
    }
    
    bindEvent() {
        super.bindEvent();
   }
    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
";
    }
    private function getContainerWidget($name) {
        $stipendCase = $this->fromCamelCase($name);
        return 
"<?php

namespace frontend\widgets;

use yii\base\Widget;

class $name extends Widget {
    
    public \$id;
    
    public function init() {
        
    }
    
    public function run() {
        return \$this->render('$stipendCase', ['id' => \$this->id]);
    }
}
";
    }
    
    
    private function getFooterText() {
        return "}";
    }
}