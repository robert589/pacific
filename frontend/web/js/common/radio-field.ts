import {Field} from './Field';
import {System} from './../common/system';

export class RadioField extends Field {

    protected inputElements : HTMLInputElement[];
    
    constructor(root : HTMLElement) {
        super(root);
    }

    decorate() {
        super.decorate();
        this.inputElements = [];
        let rawInputs : NodeListOf<Element> = this.root.getElementsByClassName('radio-field-item');
        for(let i = 0 ; i < rawInputs.length  ; i++) {
            this.inputElements.push(<HTMLInputElement>rawInputs.item(i));
        }
    }

    bindEvent() {
    }


    detach() {
    }

    getValue() : Object {
        for(let i = 0; i < this.inputElements.length; i++) {
            if(this.inputElements[i].checked) {
                return this.inputElements[i].value;
            }
        }
        return null;
    }

}