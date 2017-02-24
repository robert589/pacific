import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {SearchField} from './../common/search-field';

export class AddEntityRelationForm extends Form{

    codeField : InputField;

    subcode : SearchField;

    rules() {
        this.registerFields([this.codeField, this.subcode]);
        this.setRequiredField([this.codeField, this.subcode]);
    }
    
    constructor(root: HTMLElement) {
        super(root);
        this.subcode.disableItem(<string>this.codeField.getValue());
    
    }
    
    decorate() {
        super.decorate();
        this.codeField = new InputField(document.getElementById(this.id + "-code"));
        this.subcode = new SearchField(document.getElementById(this.id  + "-subcode"));    
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
