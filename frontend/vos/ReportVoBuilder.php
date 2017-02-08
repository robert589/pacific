<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * ReportVo builder
 *
 */
class ReportVoBuilder extends RVoBuilder
{
    function build() { return new ReportVo($this);  }
    //attributes

    public $id;

    public $date;

    public $shipId;

    public $remark;

    public $debet;

    public $credit;

    public $status;

    public $highlight;

    public function rules() { 
        return [
           ['id','string'],
           ['date','string'],
           ['shipId','string'],
           ['remark','string'],
           ['debet','string'],
           ['credit','string'],
           ['status','string'],
           ['highlight','string'],
        ];
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getDate() { 
        return $this->date; 
    }

    public function getShipId() { 
        return $this->shipId; 
    }

    public function getRemark() { 
        return $this->remark; 
    }

    public function getDebet() { 
        return $this->debet; 
    }

    public function getCredit() { 
        return $this->credit; 
    }

    public function getStatus() { 
        return $this->status; 
    }

    public function getHighlight() { 
        return $this->highlight; 
    }

    //setters

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setDate($date) { 
        $this->date = $date; 
    }

    public function setShipId($shipId) { 
        $this->shipId = $shipId; 
    }

    public function setRemark($remark) { 
        $this->remark = $remark; 
    }

    public function setDebet($debet) { 
        $this->debet = $debet; 
    }

    public function setCredit($credit) { 
        $this->credit = $credit; 
    }

    public function setStatus($status) { 
        $this->status = $status; 
    }

    public function setHighlight($highlight) { 
        $this->highlight = $highlight; 
    }
}