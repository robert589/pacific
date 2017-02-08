<?php
namespace frontend\models;

use common\models\Report;
use common\libraries\UserLibrary;
use common\validators\IsAdminValidator;
use common\components\RModel;
/**
 * ChangeReportStatus model
 *
 */
class ChangeReportStatus extends RModel
{

    //attributes
    public $user_id;

    public $status;

    public $report_id;
    
    private $report;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['status', 'integer'],
            ['status', 'required'],
            
            ['report_id', 'integer'],
            ['report_id', 'isReport'],
            
            ['user_id', 'checkEligibility']
        ];
    }
    
    public function isReport() {
        $this->report = Report::find()->where(['id' => $this->report_id])->one();
        if(!$this->report) {
            return $this->addError('report_id', 'We cannot find the report');
        }
     }
     
    public function checkEligibility() {
        $admin = UserLibrary::isAdmin($this->user_id);
        if(!$admin) {
            return $this->addError('user_id', 'You are not allowed');
        }
    }
    
    public function change() {
        if(!$this->validate()) {
            return false;
        }
        
        if($this->report->status == $this->status) {
            return true;
        }
        
        $this->report->status = $this->status;
        return $this->report->update();
        
        
    }

}