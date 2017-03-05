import {Field} from './Field';
import {System} from './../common/system';
import {InputField} from './input-field';

export class UploadField extends Field {

    fileField : InputField;

    url : string;

    constructor(root : HTMLElement) {
        super(root);
        this.url = this.root.getAttribute('data-url');
    }

    getValue() {
        return this.fileField.getValue();
    }

    decorate() {
        super.decorate();
        this.fileField = new InputField(document.getElementById(this.id  + "-file"));
    }

    bindEvent() {
        super.bindEvent();
        this.fileField.attachEvent('change', this.uploadField.bind(this));
    }

    uploadField() {
        $.ajax({
            url : this.url,
            
        });
    }

    detach() {
    }
}