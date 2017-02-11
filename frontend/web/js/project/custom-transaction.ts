import {Component} from '../common/component';
import {CustomTransactionForm, CustomTransactionFormSuccessJson} from './custom-transaction-form';
import {TransactionView} from './transaction-view';

export class CustomTransaction extends Component{

    form : CustomTransactionForm;
    
    area : HTMLElement;

    transactionView : TransactionView;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new CustomTransactionForm(document.getElementById(this.id + "-form"));
        this.area = <HTMLElement> this.root.getElementsByClassName('custom-transaction-area')[0];
    }
    
    bindEvent() {
        super.bindEvent();
        this.form.attachEvent(CustomTransactionForm.SUCCESS_EVENT, this.addArea.bind(this))
    }

    addArea(e) {
        if(this.transactionView) {
            this.transactionView.deconstruct();
        }
        this.area.innerHTML = "";
        let json : CustomTransactionFormSuccessJson = e.detail;
        
        let div : HTMLElement = document.createElement('div');
        div.innerHTML = json.views;

        let transactionViewRaw : HTMLElement = <HTMLElement> div.getElementsByClassName('transaction-view')[0];
        
        this.area.appendChild(transactionViewRaw);

        
        this.transactionView = new TransactionView(transactionViewRaw);
        

    }

}
