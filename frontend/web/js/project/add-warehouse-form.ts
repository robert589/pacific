import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {TextAreaField} from './../common/text-area-field';
import {SearchField} from './../common/search-field';
import {System} from './../common/system';

export class AddWarehouseForm extends Form{

    codeField : InputField;

    nameField : InputField;

    descField : TextAreaField;

    locationField : TextAreaField;

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.href = System.getBaseUrl() + "/inventory/index";            
        }
    }
    
    rules() {
        this.setRequiredField([this.nameField, this.codeField]);
        this.registerFields([this.nameField, this.descField, this.locationField, this.codeField]);
    }

    decorate() {
        super.decorate();
        this.codeField = new InputField(document.getElementById(this.id + "-code"));
        this.locationField = new TextAreaField(document.getElementById(this.id + "-location"));
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
