import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {TextAreaField} from './../common/text-area-field';
import {SearchField} from './../common/search-field';
import {System} from './../common/system';

export class CreateCodeForm extends Form{

    idField : InputField;

    nameField : InputField;

    descField : TextAreaField;

    typeIdField : SearchField;

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.href = System.getBaseUrl() + "/code/index";            
        }
    }
    
    rules() {
        this.setRequiredField([this.nameField, this.typeIdField, this.idField]);
        this.registerFields([this.nameField, this.descField, this.typeIdField, this.idField]);
    }

    decorate() {
        super.decorate();
        this.idField = new InputField(document.getElementById(this.id + "-id"));
        this.typeIdField = new SearchField(document.getElementById(this.id + "-type-id"));
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
