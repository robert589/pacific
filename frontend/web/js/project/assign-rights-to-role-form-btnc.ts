import {BtnContainer} from '../common/btn-container';
import {AssignRightsToRoleForm} from './assign-rights-to-role-form';

export class AssignRightsToRoleFormBtnc extends BtnContainer{

    form : AssignRightsToRoleForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new AssignRightsToRoleForm(document.getElementById(this.id + "-form"));    
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
