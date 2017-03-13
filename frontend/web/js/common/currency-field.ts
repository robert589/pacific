import {Field} from './Field';
import {System} from './../common/system';
import {String} from './../common/string';
import {InputField} from './input-field';
import {KeyCode} from './key-code';
import {Math} from './math';

export class CurrencyField extends Field {
    
    public static get CHAR_TO_EXCEL() : string { return "="};

    input :  InputField;

    tempRealValue : string;

    defaultValue : string;

    excelState : boolean = false;

    constructor(root : HTMLElement) {
        super(root);
    }

    public decorate() {
        super.decorate();
        this.input = new InputField(document.getElementById(this.id + "-input"));
        this.defaultValue = this.root.getAttribute('data-default-value');
        this.tempRealValue = <string>this.input.getValue();
    }


    public bindEvent() {
        super.bindEvent();
        this.input.attachInputElement("keypress", this.keyPressInput.bind(this));
        this.input.attachInputElement('keyup', this.changeInput.bind(this));
        this.input.attachInputElement("blur", this.evalValue.bind(this));
        this.input.attachInputElement("blur", this.updateField.bind(this));
        this.input.attachInputElement("focus", this.convertFromCurrency.bind(this));

    }

    convertFromCurrency() {
        let curVal : string = <string> this.input.getValue();
        if(curVal.length === 0) {
            return;
        }
        this.input.setValue("" + Math.convertFromCurrency(curVal));
    }

    evalValue(e) {
        //console
        if(this.excelState) {
            let curValue : string = <string> this.input.getValue();
            let result : string = Math.safeEval(curValue.substring(1, curValue.length) );
            if(!System.isEmptyValue(result)) {
                this.input.setValue(result);
                this.removeExcelState();
            } else {
                this.showError("Expression Not Recognized");
            }
        }
    }


    keyPressInput(e) {
        
        this.hideError();
        let keyCode : number = e.which;

        if( (keyCode >= KeyCode.ZERO && keyCode <= KeyCode.NINE) ||
            keyCode === KeyCode.DOT) {
        } 
        else if(this.excelState && (keyCode === KeyCode.MINUS || keyCode === KeyCode.PLUS ||
                                    keyCode === KeyCode.ASTERISK || keyCode === KeyCode.SLASH) 
            ){

        }
        else if(keyCode === KeyCode.EQUALS && (<string>this.input.getValue()).length === 0) {

        }
        else if(keyCode === KeyCode.ENTER_KEY && this.excelState) {
            this.evalValue(e);
        }
        else  {
            e.preventDefault();
            return false;
        }

    }

    changeInput(e) {
        let value : string = <string>this.input.getValue();
        if(value.length === 1 && value.charAt(0) === CurrencyField.CHAR_TO_EXCEL) {
            this.changeToExcelState();
            e.preventDefault();
            return;
        }

        if(value.length === 0) {
            this.removeExcelState();
        }
    }

    updateField() {
        if(this.excelState) {
            return;
        }        
        let value : string = <string>this.input.getValue();
         
        if(value.length === 0) {
            return;
        }
        let newVal : string = Math.convertToCurrency(value);
        
        this.input.setValue(newVal);
    }
    
    changeToExcelState() {
        this.excelState = true;
        this.input.addClass('currency-field-excel');
    }

    removeExcelState() {
        this.excelState = false;
        this.input.removeClass('currency-field-excel');
    }

    public getValue() : number {
        let value : string = <string> this.input.getValue();
        if(System.isEmptyValue(value)) {
            return parseInt(this.defaultValue);
        } 

        return Math.convertFromCurrency(value);
    }

    public emptyValue() {
        this.input.setValue("");
    }
    
    public setValue(number : number) {
        if(!System.isEmptyValue(number) && number !== 0) {
            this.input.setValue("");
        }
        this.input.setValue(number + "");
    }
    
}