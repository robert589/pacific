import {Component} from '../common/component';
import {CustomReportForm, CustomReportFormSuccessJson} from './custom-report-form';
import {ReportView} from './report-view';

export class CustomReport extends Component{

    form : CustomReportForm;
    
    area : HTMLElement;

    reportView : ReportView;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new CustomReportForm(document.getElementById(this.id + "-form"));
        this.area = <HTMLElement> this.root.getElementsByClassName('custom-report-area')[0];
    }
    
    bindEvent() {
        super.bindEvent();
        this.form.attachEvent(CustomReportForm.SUCCESS_EVENT, this.addArea.bind(this))
    }

    addArea(e) {
        if(this.reportView) {
            this.reportView.deconstruct();
        }
        this.area.innerHTML = "";
        let json : CustomReportFormSuccessJson = e.detail;
        
        let div : HTMLElement = document.createElement('div');
        div.innerHTML = json.views;

        let reportViewRaw : HTMLElement = <HTMLElement> div.getElementsByClassName('report-view')[0];
        
        this.area.appendChild(reportViewRaw);

        
        this.reportView = new ReportView(reportViewRaw);
        

    }

}
