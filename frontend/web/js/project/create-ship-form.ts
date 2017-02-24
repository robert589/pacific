import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {TextAreaField} from './../common/text-area-field';
import {System} from './../common/system';

export class CreateShipForm extends Form{

    nameField : InputField;

    descField : TextAreaField;

    codeField : InputField;

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.href = System.getBaseUrl() + "/ship/index";            
        }
    }
    
    rules() {
        this.setRequiredField([this.nameField, this.codeField]);
        this.registerFields([this.nameField, this.descField, this.codeField]);
    }

    decorate() {
        super.decorate( );
        this.nameField = new InputField(document.getElementById(this.id + "-name"));
        this.descField = new TextAreaField(document.getElementById(this.id + "-desc"));
        this.codeField = new InputField(document.getElementById(this.id + "-code"));
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
