import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class ListOwner extends Component{

    addBtn  : Button;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.addBtn = new Button(document.getElementById(this.id + "-add"), this.redirectToAddOwner.bind(this)); 
    }
    
    bindEvent() {
        super.bindEvent();
    }

    redirectToAddOwner() {
        window.location.href = System.getBaseUrl() + "/owner/create";
    }
    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
