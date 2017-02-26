import {Component} from '../common/component';
import {EditCodeForm} from './edit-code-form';

export class EditCode extends Component{

    form : EditCodeForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new EditCodeForm(document.getElementById(this.id + "-form"));
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
