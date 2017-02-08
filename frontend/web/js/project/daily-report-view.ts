import {Component} from '../common/component';
import {AddReportForm, AddReportFormSuccessJson} from './add-report-form';
import {DailyReportItem} from './daily-report-item';

export class DailyReportView extends Component{

    arForm : AddReportForm;

    area  : HTMLElement;

    items : DailyReportItem[];

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.arForm = new AddReportForm(document.getElementById(this.id + "-arform"));
        this.area = <HTMLElement> this.root.getElementsByClassName('dr-view-area')[0];
        this.items = [];

        let itemsRaw : NodeListOf<Element> = this.root.getElementsByClassName('dr-item');

        for(let i = 0 ; i < itemsRaw.length; i++) {
            this.items.push(new DailyReportItem(<HTMLElement>itemsRaw.item(i)));
        }
    
    }
    
    bindEvent() {
        super.bindEvent();
        this.arForm.attachEvent(AddReportForm.ADD_REPORT_FORM_SUCCESS, this.addNewDailyItem.bind(this));
    }

    addNewDailyItem(e) {
        let json : AddReportFormSuccessJson = e.detail;
        let areaRaws : string = json.views;
        let div = document.createElement('div');
        div.innerHTML = areaRaws;
        let itemRaw : HTMLElement =  <HTMLElement> div.getElementsByClassName('dr-item')[0];
        this.area.appendChild(itemRaw);
        this.items.push(new DailyReportItem(itemRaw));
    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
