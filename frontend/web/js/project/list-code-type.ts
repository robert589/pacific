import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class ListCodeType extends Component{

    addBtn  : Button;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.addBtn = new Button(document.getElementById(this.id + "-add"), this.redirectToAdd.bind(this));
        
    }

    redirectToAdd() {
        window.location.href = System.getBaseUrl() + "/code/create-type";
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
