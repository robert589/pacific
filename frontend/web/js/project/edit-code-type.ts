import {Component} from '../common/component';
import {EditCodeTypeForm} from './edit-code-type-form';

export class EditCodeType extends Component{

    form : EditCodeTypeForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new EditCodeTypeForm(document.getElementById(this.id + "-form"));
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
