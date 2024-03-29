import {Component} from '../common/component';
import {EditShipForm} from './edit-ship-form';

export class EditShip extends Component{

    form : EditShipForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new EditShipForm(document.getElementById(this.id + "-form"));
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
