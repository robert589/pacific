import {Component} from '../common/component';
import {Field} from './field';
import {Button} from './button';

export abstract class DynamicField extends Field{

    /**
     * Used to store initial state of the Dynamic Field
     */
    baseElementinString : string;

    baseElement : HTMLElement;

    fields : Field[];
    
    areaField : HTMLElement;

    addBtn : Button;

    rmvBtn : Button;

    constructor(root: HTMLElement) {
        super(root);
        this.baseElementinString = this.baseElement.innerHTML;
    }
    
    decorate() {
        super.decorate();
        this.addBtn  = new Button(document.getElementById(this.id + "-add"), 
                                                            this.addField.bind(this)); 
        this.rmvBtn = new Button(document.getElementById(this.id + "-remove"), 
                                this.removeField.bind(this))
        this.baseElement = <HTMLElement> this.root.getElementsByClassName('dynamic-field-init')[0];
        this.areaField = <HTMLElement> this.root.getElementsByClassName('dynamic-field-area')[0];
    }

    abstract addField() : void;
    


    getValue () {
        let value : Object[] = [];

        for(let i = 0 ; i < this.fields.length; i++ ) {
            value.push(this.fields[i].getValue());
        }    
        //if there is nothing
        if(value.length === 1 && value[0] === null) {
            return null;
        } 
        return value;
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

    findMaxIndexInFields() : number {
        let max = -1;
        for(let i = 0; i < this.fields.length; i++ ) {
            if(max < this.fields[i].getIndex()) {
                max = this.fields[i].getIndex();
            }
        }

        return max;
    }
    findFieldsWithMaxIndex() : Field {
        let max = -1;
        let maxField  = null;
        for(let i = 0; i < this.fields.length; i++ ) {
            if(max < this.fields[i].getIndex()) {
                max = this.fields[i].getIndex();
                maxField = this.fields[i];
            }
        }

        return maxField;
    }

    /**
     * Append the base string
     */
    addElement() : HTMLElement {
        let wrapper : HTMLElement = document.createElement('div');
        wrapper.innerHTML = this.baseElementinString;
        let raw : HTMLElement = <HTMLElement>
                         wrapper.getElementsByClassName('dynamic-field-item')[0];
        raw.setAttribute("id" , raw.getAttribute("id") + "-" 
                                + (this.findMaxIndexInFields() + 1) );
        this.areaField.appendChild(raw);
        return raw;
    }

    removeField() {
        let field : Field = this.findFieldsWithMaxIndex();
        let fieldElement : HTMLElement = document.getElementById(
                                        field.getRoot().getAttribute('id'));
        field.detach();
        this.areaField.removeChild(fieldElement);
        let index : number = this.fields.indexOf(field);
        if (index > -1) {
            this.fields.splice(index, 1);
        }
    }}
