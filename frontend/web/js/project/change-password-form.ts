import {Form} from '../common/form';
import {InputField} from '../common/input-field';
import {EqualValidation} from './../common/equal-validation';

export class ChangePasswordForm extends Form{

    curPasswordField : InputField;

    newPasswordField : InputField;

    confPasswordField : InputField;

    constructor(root: HTMLElement) {
        super(root);

        this.successCb = function() {
            window.location.reload();   
        }
    }
    
    decorate() {
        super.decorate();
        this.curPasswordField = new InputField(document.getElementById(this.id + "-cur-password-field"));
        this.newPasswordField = new InputField(document.getElementById(this.id + "-new-password-field"));
        this.confPasswordField = new InputField(document.getElementById(this.id + "-conf-password-field"));
    }

    rules() {
        this.registerFields([this.curPasswordField, this.newPasswordField, this.confPasswordField   ]);    
        this.setRequiredField([this.curPasswordField, this.newPasswordField, this.confPasswordField]);
        this.setValidations([new EqualValidation(this.newPasswordField, this.confPasswordField)]);
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
