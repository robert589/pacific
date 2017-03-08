import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';
import {AssignRightsToRoleFormBtnc} from './assign-rights-to-role-form-btnc';

export class ListRole extends Component{

    addBtn : Button;

    artrfbs : AssignRightsToRoleFormBtnc[];


    redirectToAdd() {
        window.location.href = System.getBaseUrl() + "/user/add-role";
    }

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.addBtn = new Button(document.getElementById(this.id + "-add"), this.redirectToAdd.bind(this));
        let artrfbsRaw : NodeListOf<Element> = this.root.getElementsByClassName('list-role-artrfbs');

        this.artrfbs = [];
        for(let i = 0; i < artrfbsRaw.length; i++) {
            this.artrfbs.push(new AssignRightsToRoleFormBtnc(<HTMLElement>artrfbsRaw.item(i)));
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
