import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {TextAreaField} from './../common/text-area-field';
import {System} from './../common/system';

export class CreateCodeTypeForm extends Form{

    nameField : InputField;

    descField : TextAreaField;

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.href = System.getBaseUrl() + "/code/create-type";            
        }
    }
    
    rules() {
        this.setRequiredField([this.nameField]);
        this.registerFields([this.nameField, this.descField]);
    }

    decorate() {
        super.decorate();
        this.nameField = new InputField(document.getElementById(this.id + "-name"));
        this.descField = new TextAreaField(document.getElementById(this.id + "-desc"));
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
