import {Component} from '../common/component';
import {CreateShipForm} from './create-ship-form';

export class CreateShip extends Component{

    form : CreateShipForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new CreateShipForm(document.getElementById(this.id + "-form"));
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
