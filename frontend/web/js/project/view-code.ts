import {Component} from '../common/component';
import {AddOwnerToCodeFormBtnc} from './add-owner-to-code-form-btnc';

export class ViewCode extends Component{

    aotcf : AddOwnerToCodeFormBtnc;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.aotcf = new AddOwnerToCodeFormBtnc(document.getElementById(this.id + "-aotcfb"));    
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
