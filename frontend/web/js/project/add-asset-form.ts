import {Form} from '../common/form';
import {DropdownField} from './../common/dropdown-field';
import {InputField} from './../common/input-field';
import {SearchField} from './../common/search-field';
import {TextAreaField} from './../common/text-area-field';
import {CheckboxField} from './../common/checkbox-field';

export class AddAssetForm extends Form{

    codeField : InputField;

    nameField : InputField;

    descField : TextAreaField;

    typeField : SearchField;

    methodField : DropdownField;

    statusEl : HTMLElement;

    fixedAssetField : CheckboxField;

    rules() {
        this.registerFields([this.codeField, this.nameField, this.fixedAssetField,
            this.descField, this.typeField, this.methodField]);
        this.setRequiredField([this.codeField, this.nameField,
             this.typeField, this.methodField]);
    }

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = this.successCallback;
        this.failCb = this.failCallback;
    }

    setStatus(status: string) {
        this.statusEl.innerHTML = status;
    }

    failCallback() {
        this.setStatus("Error!");

    }

    successCallback(data) {
        this.typeField.reset();
        this.codeField.setValue("");
        this.nameField.setValue("");
        this.descField.resetValue();
        this.setStatus("Success")
    }

    beforeSubmit() {
        this.setStatus("");

    }

    decorate() {
        super.decorate();
        this.codeField = new InputField(document.getElementById(this.id + "-code"));
        this.nameField = new InputField(document.getElementById(this.id + "-name"));
        this.descField = new TextAreaField(document.getElementById(this.id + "-desc"));
        this.fixedAssetField = new CheckboxField(document.getElementById(this.id + "-fixed-asset"));
        this.statusEl = <HTMLElement> this.root.getElementsByClassName('asset-form-status')[0];
        this.typeField = new SearchField(document.getElementById(this.id + "-type-id"));
        this.methodField = new DropdownField(document.getElementById(this.id + "-method"));
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
