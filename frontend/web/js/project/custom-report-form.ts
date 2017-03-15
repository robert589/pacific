import {Form} from '../common/form';
import {SearchField} from './../common/search-field';
import {InputField} from './../common/input-field';

export class CustomReportForm extends Form{
    
    public static get SUCCESS_EVENT() { return "CUSTOM_REPORT_FORM_SUCCESS_EVENT"}

    entitySF : SearchField;

    from : InputField;

    to : InputField;

    successEvent : CustomEvent;
    
    rules() {
        this.registerFields([this.entitySF, this.from, this.to]);
        this.setRequiredField([this.entitySF, this.from, this.to]);
    }

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = this.successCallback.bind(this);
    }

    successCallback(data) {
        let json : CustomReportFormSuccessJson = {
            views : data.views
        }

        this.successEvent = new CustomEvent(CustomReportForm.SUCCESS_EVENT, {detail : json});
        this.root.dispatchEvent(this.successEvent);
    }
    
    decorate() {
        super.decorate();
        this.entitySF = new SearchField(document.getElementById(this.id + "-entity"));    
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

export interface CustomReportFormSuccessJson {
    views : string
}
