import {Field} from './Field';
import {System} from './../common/system';

export class RedactorField extends Field {

    protected inputElement : Element;

    constructor(root : HTMLElement) {
        super(root);
            
    }

    decorate() {
        super.decorate();
        this.inputElement = this.root.getElementsByClassName('redactor-editor')[0];
    }

    bindEvent() {
    }

    
    detach() {
        this.inputElement = null;
    }

    unbindEvent() {
        
    }

    getValue() : Object {
        if(this.inputElement.innerHTML.length === 8) {
            return null;
        }
        return this.inputElement.innerHTML;
    }


    disable() {
        this.inputElement.setAttribute('disabled', "true");
    }
    enable() {
        this.inputElement.removeAttribute('disabled');
    }
}