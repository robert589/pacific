import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class ListCodeType extends Component{

    addBtn  : Button;

    redirectEditBtns : Button[];

    removeBtns : Button[];

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.addBtn = new Button(document.getElementById(this.id + "-add"), this.redirectToAdd.bind(this));
        this.redirectEditBtns = [];
        let redirectEditBtnsRaw : NodeListOf<Element> = this.root.getElementsByClassName('list-code-type-edit');
        for(let i = 0 ; i < redirectEditBtnsRaw.length; i++) {
            this.redirectEditBtns.push(new Button(<HTMLElement> redirectEditBtnsRaw.item(i),
                                this.redirectToEdit.bind(this, redirectEditBtnsRaw.item(i))));
        }

        this.removeBtns = [];
        let removeBtnsRaw : NodeListOf<Element> = this.root.getElementsByClassName('list-code-type-remove');
        for(let i = 0; i < removeBtnsRaw.length; i++) {
            this.removeBtns.push(new Button(<HTMLElement> removeBtnsRaw.item(i),
                                this.showRemoveDialog.bind(this, removeBtnsRaw.item(i))));
        }
    }

    redirectToAdd() {
        window.location.href = System.getBaseUrl() + "/code/create-type";
    }
    
    bindEvent() {
        super.bindEvent();
    }


    showRemoveDialog(raw : HTMLElement) {
        System.showConfirmDialog(this.removeCode.bind(null, raw)
        , "Are you sure", "Once it is deleted, you will have to ask the developer to retrieve it");        
    }

    removeCode(raw : HTMLElement) {
        let entity_id = raw.getAttribute('data-entity-id');
        let data : Object = {};
        data['entity_id'] = entity_id;

        $.ajax({
            url : System.getBaseUrl() + "/code/remove-type",
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


    redirectToEdit(raw : HTMLElement) {
        window.location.href = System.getBaseUrl() + "/code/edit-type?id=" + raw.getAttribute('data-entity-type-id');
    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
