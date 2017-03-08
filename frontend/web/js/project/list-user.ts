import {Component} from '../common/component';
import {System} from './../common/system';
import {Button} from './../common/button';
import {AddRoleToUserFormBtnc} from 
'./add-role-to-user-form-btnc';

export class ListUser extends Component{

    addBtn : Button;

    roleBtn : Button;

    artufbs : AddRoleToUserFormBtnc[];

    removeRoleBtns : Button[];

    redirectToAdd() {
        window.location.href = System.getBaseUrl() + "/user/add";
    }

    redirectToRole() {
        window.location.href = System.getBaseUrl() + "/user/role";
        
    }

    constructor(root: HTMLElement) {
        super(root);
        
    }

    showRemoveRoleDialog(raw : HTMLElement) {
        System.showConfirmDialog(this.removeRole.bind(null, raw)
            , "Are you sure", "Are you sure to remove the role?");        
        
    }

    removeRole(raw : HTMLElement) {
        let user_id = raw.getAttribute('data-user-id');
        let role_id = raw.getAttribute('data-role-id');
        let data : Object = {};
        
        data['target_user_id'] = user_id;
        data['role_id'] = role_id;

        $.ajax({
            url : System.getBaseUrl() + "/user/remove-role",
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
    
    decorate() {
        super.decorate();
        let artufbsRaw : NodeListOf<Element> = this.root.getElementsByClassName('list-user-artufb');

        this.artufbs = [];
        for(let i = 0; i < artufbsRaw.length; i++) {
            this.artufbs.push(new AddRoleToUserFormBtnc(<HTMLElement>artufbsRaw.item(i)));
        }    
        this.roleBtn = new Button(document.getElementById(this.id + "-role"), this.redirectToRole.bind(this));
        this.addBtn = new Button(document.getElementById(this.id + "-add"), this.redirectToAdd.bind(this));

        this.removeRoleBtns = [];
        let removeRoleBtnsRaw : NodeListOf<Element> = this.root.getElementsByClassName('list-user-remove-role-btn');
        for(let i = 0; i < removeRoleBtnsRaw.length ; i++) {
            this.removeRoleBtns.push(new Button(<HTMLElement>removeRoleBtnsRaw.item(i), 
                                                this.showRemoveRoleDialog.bind(this, <HTMLElement>removeRoleBtnsRaw.item(i))));
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
