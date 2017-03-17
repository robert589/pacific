import {Field} from './Field';
import {System} from './../common/system';

export class CheckboxField extends Field {

    public static get CHECKBOX_FIELD_CHANGE_VALUE()  : string {return "CHECKBOX_FIELD_CHANGE_VALUE"}

    protected inputElement : HTMLInputElement;

    changeValueEvent : CustomEvent;

    constructor(root : HTMLElement) {
        super(root);
    }

    decorate() {
        super.decorate();
        this.inputElement = <HTMLInputElement> 
                        this.root.getElementsByClassName('checkbox-field-item')[0];
       
    }

    bindEvent() {
        this.changeValueEvent = new CustomEvent(CheckboxField.CHECKBOX_FIELD_CHANGE_VALUE);
        this.inputElement.addEventListener('change', function(data) {
            this.root.dispatchEvent(this.changeValueEvent);
        }.bind(this) );
    }

  
    detach() {
        this.inputElement = null;
    }


    getValue() : number {
        return this.inputElement.checked ? 1 : 0;
    }

    
}