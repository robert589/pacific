import {BtnContainer} from '../common/btn-container';
import {AddOwnerToCodeForm} from './add-owner-to-code-form';

export class AddOwnerToCodeFormBtnc extends BtnContainer{

    form : AddOwnerToCodeForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new AddOwnerToCodeForm(document.getElementById(this.id + "-form"));
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
