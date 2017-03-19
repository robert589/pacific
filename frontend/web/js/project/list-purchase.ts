import {Component} from '../common/component';
import {Button} from './../common/button';
import {AddPurchaseForm} from './add-purchase-form';
import {String} from './../common/string'

export class ListPurchase extends Component{

    showformBtn : Button;

    formarea : HTMLElement;

    form : AddPurchaseForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new AddPurchaseForm(document.getElementById(this.id + "-form"));
        this.formarea = <HTMLElement> this.root.getElementsByClassName('list-purchase-formarea')[0];
        this.showformBtn = new Button(document.getElementById(this.id + "-showform"), this.toggleForm.bind(this));
    }
    
    toggleForm() {
        let hidden : boolean = this.formarea.classList.contains('app-hide');
        if(hidden) {
            this.showForm();
        }
        else {
            this.hideForm();
        }
    }

    showForm() {
        this.changeShowFormBtnArrowUp(true);
        this.formarea.classList.remove('app-hide')
    }

    changeShowFormBtnArrowUp(up : boolean) {
        let text : string = this.showformBtn.getText();
        if(up) {
            text = String.replaceAll(text, "down", "up");
        } else {
            text = String.replaceAll(text, "up", "down");
        }

        this.showformBtn.setText(text);
    }

    hideForm() {
        this.changeShowFormBtnArrowUp(false);
        this.formarea.classList.add('app-hide');
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
