import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {TextAreaField} from './../common/text-area-field';
import {SearchField} from './../common/search-field';
import {System} from './../common/system';
import {CheckboxField} from './../common/checkbox-field';

export class EditWarehouseForm extends Form{

    codeField : InputField;

    nameField : InputField;

    descField : TextAreaField;

    sellingPlaceField : CheckboxField;

    locationField : TextAreaField;

    idField : InputField;

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.href = System.getBaseUrl() + "/inventory/index";            
        }
    }
    
    rules() {
        this.setRequiredField([this.nameField, this.codeField, this.idField]);
        this.registerFields([this.nameField, this.descField, 
        this.sellingPlaceField, this.idField,
        this.locationField, this.codeField]);
    }

    decorate() {
        super.decorate();
        this.codeField = new InputField(document.getElementById(this.id + "-code"));
        this.locationField = new TextAreaField(document.getElementById(this.id + "-location"));
        this.idField = new InputField(document.getElementById(this.id + "-id"));
        this.nameField = new InputField(document.getElementById(this.id + "-name"));
        this.sellingPlaceField = new CheckboxField(document.getElementById(this.id + "-selling-place"));
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
