import {BtnContainer} from '../common/btn-container';
import {AddRoleToUserForm} from './add-role-to-user-form';

export class AddRoleToUserFormBtnc extends BtnContainer{

    form : AddRoleToUserForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new AddRoleToUserForm(document.getElementById(this.id + "-form"));    
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
