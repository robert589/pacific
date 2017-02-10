import {Component} from '../common/component';
import {CreateCodeForm} from './create-code-form';

export class CreateCode extends Component{

    form  : CreateCodeForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new CreateCodeForm(document.getElementById(this.id + "-form"));    
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
