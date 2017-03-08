import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';
import {AssignRightsToRoleFormBtnc} from './assign-rights-to-role-form-btnc';

export class ListRole extends Component{

    addBtn : Button;

    artrfbs : AssignRightsToRoleFormBtnc[];
    
    removeRightBtns : Button[];

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

        this.removeRightBtns = [];
        let removeRightBtnsRaw : NodeListOf<Element> = this.root.getElementsByClassName('list-role-remove-rights-btn');
        for(let i = 0; i < removeRightBtnsRaw.length ; i++) {
            this.removeRightBtns.push(new Button(<HTMLElement>removeRightBtnsRaw.item(i), 
                                                this.showRemoveRightDialog.bind(this, <HTMLElement>removeRightBtnsRaw.item(i))));
        }
    }


    showRemoveRightDialog(raw : HTMLElement) {
        System.showConfirmDialog(this.removeRight.bind(null, raw)
            , "Are you sure", "Are you sure to remove the right?");        
        
    }

    removeRight(raw : HTMLElement) {
        let access_control_id = raw.getAttribute('data-right-id');
        let role_id = raw.getAttribute('data-role-id');
        let data : Object = {};
        
        data['access_control_id'] = access_control_id;
        data['role_id'] = role_id;

        $.ajax({
            url : System.getBaseUrl() + "/user/remove-access",
            data : System.addCsrf(data),
            context : this,
            dataType : "json",
            method  : "post",
            success : function(data) {
                if(data.status) {
                    window.location.reload();
                }
            },
            error : function(data) {
            }
        });
    
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
