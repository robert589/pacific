import {Component} from '../common/component';
import {CreateCodeTypeForm} from './create-code-type-form';

export class CreateCodeType extends Component{

    form : CreateCodeTypeForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new CreateCodeTypeForm(document.getElementById(this.id + "-form"));    
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
