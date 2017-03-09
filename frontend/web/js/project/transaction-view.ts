import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';
import {String} from './../common/string';

export class TransactionView extends Component{

    printBtn : Button;

    area : HTMLElement;

    printAsUtang : Button;

    printAsPiutang : Button;

    additionalTitleEl : HTMLElement;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.printBtn = new Button(document.getElementById(this.id + "-printer"), this.print.bind(this));
        this.area = <HTMLElement>this.root.getElementsByClassName('transaction-view-area')[0];
        this.printAsPiutang = new Button(document.getElementById(this.id + "-piutang"), 
                                    this.print.bind(this, "Kartu Piutang"));
        this.printAsUtang = new Button(document.getElementById(this.id + "-utang"), 
                                    this.print.bind(this, "Kartu Utang"));
        this.additionalTitleEl = <HTMLElement> this.root.getElementsByClassName('transaction-view-add-title')[0];
        
    }

    print(addTitle : string) {
        this.addAdditionalTitle(addTitle);
        //REMOVE hide 600
        let printString = String.replaceAll(this.area.innerHTML, "hide600", "");        
        System.printToPrinter(printString);
    }

    addAdditionalTitle(addTitle : string) {
        this.additionalTitleEl.innerHTML = addTitle;
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
