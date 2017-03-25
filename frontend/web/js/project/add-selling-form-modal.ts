import {Modal} from '../common/modal';
import {AddSellingForm} from './add-selling-form';

export class AddSellingFormModal extends Modal{

    form  : AddSellingForm;

    constructor(root: HTMLElement) {    
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new AddSellingForm(document.getElementById(this.id + "-form"));    
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

    setDate(date : string) {
        this.form.setDate(date);
    }
}
