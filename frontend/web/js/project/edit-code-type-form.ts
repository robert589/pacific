import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {TextAreaField} from './../common/text-area-field';
import {System} from './../common/system';

export class EditCodeTypeForm extends Form{

    idField : InputField;

    nameField : InputField;

    descField : TextAreaField;

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.href = System.getBaseUrl() + "/code/type";            
        }
    }
    
    rules() {
        this.setRequiredField([this.nameField, this.idField]);
        this.registerFields([this.nameField, this.descField, this.idField]);
    }

    decorate() {
        super.decorate();
        this.idField = new InputField(document.getElementById(this.id + "-id"));
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
