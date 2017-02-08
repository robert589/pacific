import {Component} from '../common/component';
import {CreateOwnerForm} from './create-owner-form';

export class CreateOwner extends Component{

    form : CreateOwnerForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new CreateOwnerForm(document.getElementById(this.id + "-form"));    
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
