import {Component} from '../common/component';
import {AddOwnerToCodeFormBtnc} from './add-owner-to-code-form-btnc';
import {Button} from './../common/button';
import {System} from './../common/system';

export class ViewCode extends Component{

    aotcf : AddOwnerToCodeFormBtnc;

    entityId : string;

    editBtn : Button;

    subcodeBtn : Button;

    removeBtns : Button[];

    redirectToAddRelationView() {
        window.location.href = System.getBaseUrl() + "/code/add-relation?id=" + this.entityId;
    }

    redirectToEdit() {
        window.location.href = System.getBaseUrl() + "/code/edit?id=" + this.entityId;
    }

    constructor(root: HTMLElement) {
        super(root);
        this.entityId = this.root.getAttribute('data-entity-id');
    }
    
    decorate() {
        super.decorate();
        this.aotcf = new AddOwnerToCodeFormBtnc(document.getElementById(this.id + "-aotcfb"));    
        this.editBtn = new Button(document.getElementById(this.id + "-edit"), this.redirectToEdit.bind(this));
        this.subcodeBtn = new Button(document.getElementById(this.id + "-subcode"), 
                                    this.redirectToAddRelationView.bind(this));

        this.removeBtns = [];
        let removeBtnsRaw  : NodeListOf<Element> = this.root.getElementsByClassName('view-code-remove');
        for(let i = 0; i < removeBtnsRaw.length; i++ ) {
            this.removeBtns.push(new Button(<HTMLElement> removeBtnsRaw.item(i),
                         this.showRemoveDialog.bind(this, removeBtnsRaw.item(i))));
        }
    }


    showRemoveDialog(raw : HTMLElement) {
        System.showConfirmDialog(this.removeOwner.bind(this, raw)
        , "Are you sure", "Are you sure to delete this owner?");        
    }

    removeOwner(raw : HTMLElement) {
        let userId = raw.getAttribute('data-user-id');
        let data : Object = {};
        data['entity_id'] = this.entityId;
        data['target_user_id'] = userId;

        $.ajax({
            url : System.getBaseUrl() + "/code/remove-owner",
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
