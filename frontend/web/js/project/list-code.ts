import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class ListCode extends Component{

    addBtn  : Button;

    redirectEditBtns : Button[];

    removeBtns : Button[];

    codeType : Button;

    addRelations : Button[];

    constructor(root: HTMLElement) {
        super(root);
    }

    redirectToAdd() {
        window.location.href = System.getBaseUrl() + "/code/create";
    }

    redirectToCodeType() {
        window.location.href = System.getBaseUrl() + "/code/type";
    }
    
    decorate() {
        super.decorate();
        this.addBtn = new Button(document.getElementById(this.id + "-add"), this.redirectToAdd.bind(this));
        this.codeType = new Button(document.getElementById(this.id + "-codetype"), this.redirectToCodeType.bind(this));
    
        this.addRelations = [];
        let relationRaws : NodeListOf<Element> = this.root.getElementsByClassName('list-code-add');
        for(let i = 0; i  < relationRaws.length; i++ ) {
            this.addRelations.push(new Button(<HTMLElement>relationRaws.item(i), 
                                this.redirectToAddRelation.bind(this, relationRaws.item(i))));
        }

        this.redirectEditBtns = [];
        let redirectEditBtnsRaw : NodeListOf<Element> = this.root.getElementsByClassName('list-code-edit');
        for(let i = 0 ; i < redirectEditBtnsRaw.length; i++) {
            this.redirectEditBtns.push(new Button(<HTMLElement> redirectEditBtnsRaw.item(i),
                                this.redirectToEdit.bind(this, redirectEditBtnsRaw.item(i))));
        }

        this.removeBtns = [];
        let removeBtnsRaw : NodeListOf<Element> = this.root.getElementsByClassName('list-code-remove');
        for(let i = 0; i < removeBtnsRaw.length; i++) {
            this.removeBtns.push(new Button(<HTMLElement> removeBtnsRaw.item(i),
                                this.showRemoveDialog.bind(this, removeBtnsRaw.item(i))));
        }

    }

    showRemoveDialog(raw : HTMLElement) {
        System.showConfirmDialog(this.removeCode.bind(null, raw)
        , "Are you sure", "Once it is deleted, you will lose the code");        
    }

    removeCode(raw : HTMLElement) {
        let entity_id = raw.getAttribute('data-entity-id');
        let data : Object = {};
        data['entity_id'] = entity_id;

        $.ajax({
            url : System.getBaseUrl() + "/code/remove",
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
        window.location.href = System.getBaseUrl() + "/code/edit?id=" + raw.getAttribute('data-entity-id');
    }

    redirectToAddRelation(raw : HTMLElement) {
        window.location.href = System.getBaseUrl() + "/code/add-relation?id=" + raw.getAttribute('data-entity-id');
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
