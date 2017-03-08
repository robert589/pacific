import {Form} from '../common/form';
import {SearchField} from './../common/search-field';
import {InputField} from './../common/input-field';

export class AssignRightsToRoleForm extends Form{

    accessField : SearchField;

    roleField : InputField;

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.reload();   
        }
    }

    rules() {
        this.registerFields([this.roleField, this.accessField]);
        this.setRequiredField([this.roleField, this.accessField]);
    }
    
    decorate() {
        super.decorate();
        this.roleField = new InputField(document.getElementById(this.id + "-role-id"));
        this.accessField = new SearchField(document.getElementById(this.id + "-rights"));
        
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
