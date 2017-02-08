import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class ListShip extends Component{
    
    addBtn  : Button;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.addBtn = new Button(document.getElementById(this.id + "-add"), this.redirectToAddShip.bind(this)); 
    
    }
    
    redirectToAddShip() {
        window.location.href = System.getBaseUrl() + "/ship/create";
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
