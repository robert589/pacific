import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class OwnershipGridview extends Component{

    deletes : Button[];

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        let elements : NodeListOf<Element> = this.root.getElementsByClassName('own-gv-delete');
        this.deletes = [];
        for(let i = 0; i < elements.length; i++) {
            this.deletes.push(new Button(<HTMLElement> elements.item(i), 
            this.showDeleteDialog.bind(this, elements.item(i))));
        }
    }

    showDeleteDialog(raw : HTMLElement) {
        System.showConfirmDialog(this.deleteOwnership.bind(null, raw)
            , "Are you sure", "Are you sure?");        
    
    }

    deleteOwnership(raw : HTMLElement) {
        let shipId = raw.getAttribute('data-ship-id');
        let ownerId = raw.getAttribute('data-owner-id');
        let data : Object = {};
        data['ship_id'] = shipId;
        data['owner_id'] = ownerId;

        $.ajax({
            url : System.getBaseUrl() + "/ship/remove-owner",
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
