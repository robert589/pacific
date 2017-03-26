import {Modal} from '../common/modal';
import {AddAssetForm} from './add-asset-form';

export class AddAssetFormModal extends Modal{

    form : AddAssetForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new AddAssetForm(document.getElementById(this.id + "-form"));    
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
