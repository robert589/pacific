import {Form} from '../common/form';
import {SearchField} from './../common/search-field';
import {InputField} from './../common/input-field';

export class AddOwnerToCodeForm extends Form{

    userField : SearchField;

    entityIdField : InputField;

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.reload();   
        }
    }

    rules() {
        this.registerFields([this.entityIdField, this.userField]);
        this.setRequiredField([this.entityIdField, this.userField]);
    }
    
    decorate() {
        super.decorate();
        this.entityIdField = new InputField(document.getElementById(this.id + "-entity-id"));
        this.userField = new SearchField(document.getElementById(this.id + "-user-id"));
        
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
