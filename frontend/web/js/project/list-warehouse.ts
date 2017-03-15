import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class ListWarehouse extends Component{

    add : Button;

    redirectToAddWarehouse() {
        window.location.href = System.getBaseUrl() + "/inventory/add-warehouse";
    }   

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.add = new Button(document.getElementById(this.id + "-add"), this.redirectToAddWarehouse.bind(this));
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
