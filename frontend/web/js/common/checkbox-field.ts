import {Field} from './Field';
import {System} from './../common/system';

export class CheckboxField extends Field {
    protected inputElement : HTMLInputElement;

    
    constructor(root : HTMLElement) {
        super(root);
    }

    decorate() {
        super.decorate();
        this.inputElement = <HTMLInputElement> 
                        this.root.getElementsByClassName('checkbox-field-item')[0];
       
    }

    bindEvent() {
    }

  
    detach() {
        this.inputElement = null;
    }


    getValue() : Object {
        return this.inputElement.checked;
    }

    
}