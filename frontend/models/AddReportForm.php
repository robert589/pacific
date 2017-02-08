<?php
namespace frontend\models;

use common\models\Report;
use common\validators\DateValidator;
use common\validators\IsAdminValidator;
use common\components\RModel;
/**
 * AddReportForm model
 *
 */
class AddReportForm extends RModel
{

    //attributes
    public $user_id;

    public $date;

    public $ship_id;

    public $remark;

    public $debet;

    public $credit;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()],
            
            ['ship_id', 'integer'],
            ['ship_id', 'required'],
            
            ['remark', 'string'],
            ['remark', 'required'],
            
            ['debet', 'double'],
            ['debet', 'required'],
            
            ['credit', 'double'],
            ['credit', 'required'],
            
            ['date', 'string'],
            ['date', DateValidator::className()],
            ['date', 'required']
        ];
    }
    
    public function add() {
        if(!$this->validate()) {
            return false;
        }
        
        $report = new Report();
        $report->ship_id = $this->ship_id;
        $report->date = $this->date;
        $report->debet = $this->debet;
        $report->credit = $this->credit;
        $report->remark = $this->remark;
        $report->status = Report::STATUS_ACTIVE;
        
        return ($report->save()) ? $report : null;
        
    }
}