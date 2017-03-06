import {Component} from '../common/component';
import {AddUserForm} from './add-user-form';

export class AddUser extends Component{

    form : AddUserForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new AddUserForm(document.getElementById(this.id + "-form"));    
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
