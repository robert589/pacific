import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class DailyReportItem extends Component{

    viewArea : HTMLElement;

    removeArea : HTMLElement;

    removeBtn : Button;

    cancelRemove : Button;

    reportId : string;
    
    constructor(root: HTMLElement) {
        super(root);
        this.reportId =  this.root.getAttribute('data-report-id');
    }
    
    decorate() {
        super.decorate();
        this.viewArea = document.getElementById(this.id + "-view");
        this.removeArea = document.getElementById(this.id + "-remove-area");
        this.removeBtn = new Button(document.getElementById(this.id + "-remove-btn"),
                                    this.removeItem.bind(this));
        this.cancelRemove = new Button(document.getElementById(this.id + "-cancel"),
                                this.cancelRemoveItem.bind(this));
    }

    removeItem() {
        this.removeBtn.disable(true);
        let data = {};
        data['report_id'] = this.reportId;
        $.ajax({
            url : System.getBaseUrl() + "/report/remove",
            data : System.addCsrf(data),
            dataType : "json",
            method : "post",
            context : this,
            success : function(data) {
                this.removeBtn.disable(false);
                this.viewArea.classList.add('app-hide');
                this.removeArea.classList.remove('app-hide');
            },
            error : function(data) {
                this.removeBtn.disable(false);
            }
        })
    }

    cancelRemoveItem() {
        this.cancelRemove.disable(true);
        let data = {};
        data['report_id'] = this.reportId;
        $.ajax({
            url : System.getBaseUrl() + "/report/cancel-remove",
            data : System.addCsrf(data),
            dataType : "json",
            method : "post",
            context : this,
            success : function(data) {
                this.cancelRemove.disable(false);
                this.viewArea.classList.remove('app-hide');
                this.removeArea.classList.add('app-hide');
            },
            error : function(data) {
                this.removeBtn.disable(false);
            }
        })
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
