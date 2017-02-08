import {Form} from '../common/form';
import {InputField} from '../common/input-field';
import {Button} from '../common/button';
import {System} from '../common/system';
export class LoginForm extends Form {

    emailField : InputField;
    passwordField : InputField;
   
    constructor(root: HTMLElement) {
        super(root);        
        this.failCb = function() {
        }.bind(this);
        this.successCb = function(data) {
            window.location.reload();
         }.bind(this);
    }

    rules() {
        this.setRequiredField([this.emailField, this.passwordField]);
        this.setEmailField([this.emailField]);
    }

        
    decorate() {
        super.decorate();
        this.emailField = new InputField(document.getElementById(this.id + "-email-field"));
        this.passwordField = new InputField(document.getElementById(this.id + "-password-field"));
        this.registerFields([this.emailField, this.passwordField]);
    }
        
}
