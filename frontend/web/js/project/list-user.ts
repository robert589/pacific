import {Component} from '../common/component';
import {System} from './../common/system';
import {Button} from './../common/button';

export class ListUser extends Component{

    addBtn : Button;

    roleBtn : Button;

    redirectToAdd() {
        window.location.href = System.getBaseUrl() + "/user/add";
    }

    redirectToRole() {
        window.location.href = System.getBaseUrl() + "/user/role";
        
    }

    constructor(root: HTMLElement) {
        super(root);
        this.roleBtn = new Button(document.getElementById(this.id + "-role"), this.redirectToRole.bind(this));
        this.addBtn = new Button(document.getElementById(this.id + "-add"), this.redirectToAdd.bind(this));
  
    }
    
    decorate() {
        super.decorate();
        
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
