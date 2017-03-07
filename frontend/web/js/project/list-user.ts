import {Component} from '../common/component';
import {System} from './../common/system';
import {Button} from './../common/button';
import {AddRoleToUserFormBtnc} from 
'./add-role-to-user-form-btnc';

export class ListUser extends Component{

    addBtn : Button;

    roleBtn : Button;

    artufbs : AddRoleToUserFormBtnc[];
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
        let artufbsRaw : NodeListOf<Element> = this.root.getElementsByClassName('list-user-artufb');

        this.artufbs = [];
        for(let i = 0; i < artufbsRaw.length; i++) {
            this.artufbs.push(new AddRoleToUserFormBtnc(<HTMLElement>artufbsRaw.item(i)));
        }    
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
