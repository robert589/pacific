import {Component} from '../common/component';
import {AddWarehouseForm} from './add-warehouse-form';

export class AddWarehouse extends Component{

    form : AddWarehouseForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new AddWarehouseForm(document.getElementById(this.id + "-form"));
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
