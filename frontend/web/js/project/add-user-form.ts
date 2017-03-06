import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {TextAreaField} from './../common/text-area-field';
import {System} from './../common/system';

export class AddUserForm extends Form{
    firstNameField  :  InputField;

    lastNameField : InputField;

    emailField : InputField;

    passwordField : InputField;

    successfullyAddedEvent : CustomEvent;

    constructor(root: HTMLElement) {
        super(root);
        this.successCb   = function(data) {
            window.location.href = System.getBaseUrl() + "/user/list";
        }.bind(this);
    }
    
    rules() {
        this.setRequiredField([this.firstNameField, this.emailField, this.passwordField]);
        this.registerFields([this.firstNameField, this.lastNameField,  this.emailField, this.passwordField]);
    }

    decorate() {
        super.decorate();
        this.firstNameField = new InputField(document.getElementById(this.id + "-first-name"));
        this.lastNameField = new InputField(document.getElementById(this.id + "-last-name"));
        this.emailField = new InputField(document.getElementById(this.id + "-email"));
        this.passwordField = new InputField(document.getElementById(this.id + "-password"));
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
