import {Form} from '../common/form';
import {SearchField} from './../common/search-field';
import {InputField} from './../common/input-field';
import {CheckboxField} from './../common/checkbox-field';

export class CustomTransactionForm extends Form{
    
    public static get SUCCESS_EVENT() { return "CUSTOM_TRANSACTION_FORM_SUCCESS_EVENT"}

    code : SearchField;

    from : InputField;

    to : InputField;

    successEvent : CustomEvent;
    
    showDateField : CheckboxField;

    showRemarkField : CheckboxField;

    showCodeField : CheckboxField;

    showDebetField : CheckboxField;

    showCreditField : CheckboxField;

    showSaldoField : CheckboxField;

    rules() {
        this.registerFields([this.code, this.from, this.showCodeField, this.showSaldoField, this.showDateField, 
                            this.showRemarkField, this.showCreditField, this.showDebetField, this.to]);
        this.setRequiredField([this.code, this.from, this.to]);
    }

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = this.successCallback.bind(this);
    }

    successCallback(data) {
        let json : CustomTransactionFormSuccessJson = {
            views : data.views
        }

        this.successEvent = new CustomEvent(CustomTransactionForm.SUCCESS_EVENT, {detail : json});
        this.root.dispatchEvent(this.successEvent);
    }
    
    decorate() {
        super.decorate();
        this.code = new SearchField(document.getElementById(this.id + "-code"));    
        this.from = new InputField(document.getElementById(this.id + "-from"));
        this.to = new InputField(document.getElementById(this.id + "-to"));
        this.showCodeField = new CheckboxField(document.getElementById(this.id +  "-show-code"));
        this.showSaldoField = new CheckboxField(document.getElementById(this.id +  "-show-saldo"));
        this.showDateField = new CheckboxField(document.getElementById(this.id +  "-show-date"));
        this.showRemarkField = new CheckboxField(document.getElementById(this.id +  "-show-remark"));
        this.showCreditField = new CheckboxField(document.getElementById(this.id +  "-show-credit"));
        this.showDebetField = new CheckboxField(document.getElementById(this.id +  "-show-debet"));
    }
    
    bindEvent() {
        super.bindEvent();
        this.showCodeField.attachEvent(CheckboxField.CHECKBOX_FIELD_CHANGE_VALUE, this.refreshSubmit.bind(this));
        this.showSaldoField.attachEvent(CheckboxField.CHECKBOX_FIELD_CHANGE_VALUE, this.refreshSubmit.bind(this));
        this.showDateField.attachEvent(CheckboxField.CHECKBOX_FIELD_CHANGE_VALUE, this.refreshSubmit.bind(this));
        this.showRemarkField.attachEvent(CheckboxField.CHECKBOX_FIELD_CHANGE_VALUE, this.refreshSubmit.bind(this));
        this.showDebetField.attachEvent(CheckboxField.CHECKBOX_FIELD_CHANGE_VALUE, this.refreshSubmit.bind(this));
        this.showCreditField.attachEvent(CheckboxField.CHECKBOX_FIELD_CHANGE_VALUE, this.refreshSubmit.bind(this));
    }

    refreshSubmit(e) {
        if(this.validate(false)) {
            this.submit(e);
        }
    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}

export interface CustomTransactionFormSuccessJson {
    views : string
}
            