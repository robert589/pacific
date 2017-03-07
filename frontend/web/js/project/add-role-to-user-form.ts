import {Form} from '../common/form';
import {SearchField} from './../common/search-field';
import {InputField} from './../common/input-field';

export class AddRoleToUserForm extends Form{

    roleField : SearchField;

    userField : InputField;

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.reload();   
        }
    }

    rules() {
        this.registerFields([this.roleField, this.userField]);
        this.setRequiredField([this.roleField, this.userField]);
    }
    
    decorate() {
        super.decorate();
        this.roleField = new SearchField(document.getElementById(this.id + "-role"));
        this.userField = new InputField(document.getElementById(this.id + "-user-id"));
        
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
