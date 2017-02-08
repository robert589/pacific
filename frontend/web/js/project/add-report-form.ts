import {Form} from '../common/form';
import {InputField} from './../common/input-field';

export class AddReportForm extends Form{

    public static get ADD_REPORT_FORM_SUCCESS() { return "addreportformsuccess"};

    successEvent : CustomEvent;

    debetField : InputField;

    remarkField : InputField;

    creditField : InputField;

    shipField : InputField;

    date : InputField;

    rules() {
        this.registerFields([this.debetField, this.remarkField,
                    this.shipField, this.date, this.creditField]);
    
        this.setRequiredField([this.debetField, this.shipField,
        this.date,
        this.remarkField, this.creditField]);
    }

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = this.successCallback.bind(this);
    }

    successCallback(data) {
        let json : AddReportFormSuccessJson = {
                views : data.views
            }
        this.successEvent = new CustomEvent(AddReportForm.ADD_REPORT_FORM_SUCCESS,
                        {detail : json});
        this.root.dispatchEvent(this.successEvent);

        this.debetField.setValue("0");
        this.remarkField.setValue("");
        this.creditField.setValue("0");
    }
    
    decorate() {
        super.decorate();
        this.shipField = new InputField(document.getElementById(this.id + "-ship"));
        this.date = new InputField(document.getElementById(this.id + "-date"));
        this.debetField = new InputField(document.getElementById(this.id + "-debet"));
        this.remarkField = new InputField(document.getElementById(this.id + "-remark"));
        this.creditField = new InputField(document.getElementById(this.id + "-credit"));
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

export interface  AddReportFormSuccessJson {
    views : string
}