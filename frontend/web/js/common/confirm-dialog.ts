import {Modal} from './modal';
import {System} from './../common/system';
import {Button} from './../common/button';

export class ConfirmDialog extends Modal {

    okBtn : Button;

    cancelBtn : Button;
    
    text : HTMLElement;

    constructor(root : HTMLElement) {
        super(root);
    }

    decorate() {
        super.decorate();
        this.text = <HTMLElement> this.root.getElementsByClassName('cdialog-text')[0];
    }

    setText(text : string) {
        this.text.innerHTML = text;
    }

    clickOk(cb : () => any) {
        cb();
        this.hide();
    }

    clickCancel() {
        this.hide();
    }

    bindEvent() {
        super.bindEvent();
    
    }

  
    detach() {
    }

    run(cb : () => any) {
        this.okBtn = new Button(document.getElementById(this.id + "-ok"), this.clickOk.bind(this, cb) );
        this.cancelBtn = new Button(document.getElementById(this.id + "-cancel"), this.clickCancel.bind(this));
        this.show();
    }

    
}