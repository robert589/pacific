import {Component} from '../common/component';
import {EditWarehouseForm} from './edit-warehouse-form';

export class EditWarehouse extends Component{

    form : EditWarehouseForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new EditWarehouseForm(document.getElementById(this.id + "-form"));    
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
