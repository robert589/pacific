import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class TransactionView extends Component{

    printBtn : Button;

    area : HTMLElement;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.printBtn = new Button(document.getElementById(this.id + "-printer"), this.print.bind(this));
        this.area = <HTMLElement>this.root.getElementsByClassName('transaction-view-area')[0];
    }


    print(e : Event) {
        System.printToPrinter(this.area.innerHTML);
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
