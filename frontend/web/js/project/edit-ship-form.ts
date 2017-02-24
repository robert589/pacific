import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {TextAreaField} from './../common/text-area-field';
import {System} from './../common/system';

export class EditShipForm extends Form{

    nameField : InputField;

    descField : TextAreaField;

    idField : InputField;

    newIdField : InputField;

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.href = System.getBaseUrl() + "/ship/edit?id=" + this.newIdField.getValue();            
        }.bind(this);
    }
    
    rules() {
        this.setRequiredField([this.nameField, this.idField, this.newIdField]);
        this.registerFields([this.nameField, this.descField, this.idField, this.newIdField]);
    }

    decorate() {
        super.decorate();
        this.nameField = new InputField(document.getElementById(this.id + "-name"));
        this.descField = new TextAreaField(document.getElementById(this.id + "-desc"));
        this.idField = new InputField(document.getElementById(this.id + "-id"));
        this.newIdField = new InputField(document.getElementById(this.id + "-new-id"));
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
