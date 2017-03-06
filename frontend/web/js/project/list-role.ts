import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class ListRole extends Component{

    addBtn : Button;

    redirectToAdd() {
        window.location.href = System.getBaseUrl() + "/user/add-role";
    }

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.addBtn = new Button(document.getElementById(this.id + "-add"), this.redirectToAdd.bind(this));
        
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
