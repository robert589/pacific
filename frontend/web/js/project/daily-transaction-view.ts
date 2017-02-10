import {Component} from '../common/component';
import {AddTransactionForm, AddTransactionFormSuccessJson} from './add-transaction-form';
import {DailyTransactionItem} from './daily-transaction-item';

export class DailyTransactionView extends Component{

    atForm : AddTransactionForm;

    area  : HTMLElement;

    items : DailyTransactionItem[];

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.atForm = new AddTransactionForm(document.getElementById(this.id + "-atform"));
        this.area = <HTMLElement> this.root.getElementsByClassName('dt-view-area')[0];
        this.items = [];

        let itemsRaw : NodeListOf<Element> = this.root.getElementsByClassName('dt-item');

        for(let i = 0 ; i < itemsRaw.length; i++) {
            this.items.push(new DailyTransactionItem(<HTMLElement>itemsRaw.item(i)));
        }
    
    }
    
    bindEvent() {
        super.bindEvent();
        this.atForm.attachEvent(AddTransactionForm.ADD_TRANSACTION_FORM_SUCCESS, this.addNewDailyItem.bind(this));
    }

    addNewDailyItem(e) {
        let json : AddTransactionFormSuccessJson = e.detail;
        let areaRaws : string = json.views;
        let div = document.createElement('div');
        div.innerHTML = areaRaws;
        let itemRaw : HTMLElement =  <HTMLElement> div.getElementsByClassName('dt-item')[0];
        this.area.appendChild(itemRaw);
        this.items.push(new DailyTransactionItem(itemRaw));
    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
