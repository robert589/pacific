import {Form} from '../common/form';
import {SearchField} from './../common/search-field';
import {InputField} from './../common/input-field';

export class CustomTransactionForm extends Form{
    
    public static get SUCCESS_EVENT() { return "CUSTOM_TRANSACTION_FORM_SUCCESS_EVENT"}

    code : SearchField;

    from : InputField;

    to : InputField;

    successEvent : CustomEvent;
    
    rules() {
        this.registerFields([this.code, this.from, this.to]);
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

export interface CustomTransactionFormSuccessJson {
    views : string
}
            