import {Form} from '../common/form';
import {SearchField} from './../common/search-field';
import {InputField} from './../common/input-field';

export class CustomSellingForm extends Form{
    
    public static get SUCCESS_EVENT() { return "CUSTOM_SELLING_FORM_SUCCESS_EVENT"}

    ship : SearchField;

    from : InputField;

    to : InputField;

    successEvent : CustomEvent;
    
    rules() {
        this.registerFields([this.ship, this.from, this.to]);
        this.setRequiredField([this.ship, this.from, this.to]);
    }

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = this.successCallback.bind(this);
    }

    successCallback(data) {
        let json : CustomSellingFormSuccessJson = {
            views : data.views
        }

        this.successEvent = new CustomEvent(CustomSellingForm.SUCCESS_EVENT, {detail : json});
        this.root.dispatchEvent(this.successEvent);
    }
    
    decorate() {
        super.decorate();
        this.ship = new SearchField(document.getElementById(this.id + "-ship"));    
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

export interface CustomSellingFormSuccessJson {
    views : string
}