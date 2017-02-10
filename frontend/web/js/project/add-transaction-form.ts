import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {SearchField} from './../common/search-field';

export class AddTransactionForm extends Form{
    
    public static get ADD_TRANSACTION_FORM_SUCCESS() { return "addtransactionformsuccess"};

    successEvent : CustomEvent;

    debetField : InputField;

    remarkField : InputField;

    creditField : InputField;

    codeField : SearchField;

    date : InputField;

    rules() {
        this.registerFields([this.debetField, this.remarkField,
                    this.codeField, this.date, this.creditField]);
    
        this.setRequiredField([this.debetField, this.codeField,
                                this.date,
                                this.remarkField, this.creditField]);
    }

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = this.successCallback.bind(this);
    }

    successCallback(data) {
        let json : AddTransactionFormSuccessJson = {
                views : data.views
            }
        this.successEvent = new CustomEvent(AddTransactionForm.ADD_TRANSACTION_FORM_SUCCESS,
                        {detail : json});
        this.root.dispatchEvent(this.successEvent);

        this.debetField.setValue("0");
        this.remarkField.setValue("");
        this.creditField.setValue("0");
    }
    
    decorate() {
        super.decorate();
        this.date = new InputField(document.getElementById(this.id + "-date"));
        this.debetField = new InputField(document.getElementById(this.id + "-debet"));
        this.remarkField = new InputField(document.getElementById(this.id + "-remark"));
        this.creditField = new InputField(document.getElementById(this.id + "-credit"));
        this.codeField = new SearchField(document.getElementById(this.id + "-code"));
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
}

export interface  AddTransactionFormSuccessJson {
    views : string
}
