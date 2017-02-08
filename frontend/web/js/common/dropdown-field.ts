import {Field} from './field';
import {InputField} from './input-field';
import {System} from './system';

export class DropdownField extends Field {

    public static get CHANGE_VALUE() : string {return "DROPDOWN_FIELD_CHANGED_VALUE"}

    changedValueEvent : CustomEvent;

    upIcon : HTMLElement;

    downIcon : HTMLElement;

    dropdown : HTMLElement;

    textElement : HTMLElement;

    inputArea : HTMLElement;

    dropdowns : Element[];

    inputElement : InputField;

    placeholderElement : HTMLElement;

    constructor(root : HTMLElement) {
        super(root);
        this.initValue();
    }

    public decorate() {
        super.decorate();
        this.upIcon = <HTMLElement> this.root.getElementsByClassName('dropdown-field-down')[0];
        this.downIcon = <HTMLElement> this.root.getElementsByClassName('dropdown-field-up')[0];
        this.dropdown = <HTMLElement> this.root.getElementsByClassName('dropdown-field-dropdown')[0];
        this.inputArea = <HTMLElement> this.root.getElementsByClassName('dropdown-field-input')[0];
        this.placeholderElement = <HTMLElement> this.root.getElementsByClassName('dropdown-field-placeholder')[0];
        this.textElement = <HTMLElement> this.root.getElementsByClassName('dropdown-field-text')[0];
        this.dropdowns = [];
        let rawDropdowns = this.root.getElementsByClassName('dropdown-field-item');
        for(let  i = 0; 
                i < rawDropdowns.length; i++) {
            this.dropdowns.push(rawDropdowns.item(i));
        }
        this.inputElement = new InputField(document.getElementById(this.id + "-input"));
    }


    initValue() {
        let index = this.root.getAttribute('data-index');
        if(!System.isEmptyValue(index)) {
            let text = this.root.getAttribute('data-text');
            if(System.isEmptyValue(text)) {
                text = this.findTextFromIndex(index);
            }
            this.setValue(text, index);
        }
    }

    public bindEvent() {
        super.bindEvent();
        this.changedValueEvent = new CustomEvent(DropdownField.CHANGE_VALUE);
        
        this.inputArea.addEventListener('click', this.toggleDropdown.bind(this));
        for(let i = 0; i < this.dropdowns.length; i++) {
            this.dropdowns[i].addEventListener('click', this.clickDropdownItem.bind(this));
        }
    }

    private findTextFromIndex(targetIndex : string) {
        for(let i = 0; i < this.dropdowns.length; i++) {
            let index = this.dropdowns[i].getAttribute('data-index');
            if(index === targetIndex) {
                return this.dropdowns[i].innerHTML;
            }
        }

        return null;
    }

    clickDropdownItem(e : Event) {
        let element : HTMLElement  = <HTMLElement> e.target ;
        let index = element.getAttribute('data-index');
        let text = element.innerHTML;
        this.hideDropdown();
        this.setValue(text, index);
    }

    setValue(text : string, index : string) {
        this.inputElement.setValue(index);
        this.textElement.innerHTML = text;
        this.placeholderElement.classList.add('app-hide'); 
        this.textElement.classList.remove('app-hide');   
        //release Event
        this.root.dispatchEvent(this.changedValueEvent);
    }   
   
    public toggleDropdown() {
        if(this.dropdown.classList.contains('app-hide')) {
            this.showDropdown();
        } else {
            this.hideDropdown();
        }
    }

    public hideDropdown() {
        this.dropdown.classList.add('app-hide');
        this.downIcon.classList.add('app-hide');
        this.upIcon.classList.remove('app-hide');        
    }

    public showDropdown() {
        this.downIcon.classList.remove  ('app-hide');
        this.upIcon.classList.add('app-hide');
        this.dropdown.classList.remove('app-hide');
    }
    public getValue() {
        return this.inputElement.getValue();
    }

    
    disable() {
        this.inputElement.disable();
    }
    enable() {
        this.inputElement.enable();
    }


}