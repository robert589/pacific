import {Field} from './Field';
import {System} from './../common/system';

export class TextAreaField extends Field {

    protected inputElement : HTMLElement;

    constructor(root : HTMLElement) {
        super(root);
    }

    decorate() {
        super.decorate();
        this.inputElement = <HTMLInputElement> 
                        this.root.getElementsByClassName('text-area-field-edit')[0];
    }

    bindEvent() {
        super.bindEvent();
    }



    getValue() : Object {
        return this.inputElement.innerHTML;
    }
    
    resetValue() {
        this.inputElement.innerHTML = null;
    }
}   