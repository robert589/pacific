import {Component} from '../common/component';
import {ChangePasswordForm} from './change-password-form';

export class ChangePassword extends Component{

    form : ChangePasswordForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new ChangePasswordForm(document.getElementById(this.id + "-form"));    
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
