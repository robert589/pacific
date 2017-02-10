import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class ListShip extends Component{
    
    addBtn  : Button;

    deletes : Button[];

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.addBtn = new Button(document.getElementById(this.id + "-add"), this.redirectToAddShip.bind(this)); 
        this.deletes = []
        let deleteRaws : NodeListOf<Element> = this.root.getElementsByClassName('list-ship-delete');
        for(let i = 0; i < deleteRaws.length; i++) {
            this.deletes.push(new Button(<HTMLElement>deleteRaws.item(i), 
                        this.showDeleteDialog.bind(this, deleteRaws.item(i))));
        }
    
    }

    showDeleteDialog(raw : HTMLElement) {
        System.showConfirmDialog(this.deleteShip.bind(null, raw)
        , "Are you sure", "Once it is deleted, you have to ask admin to retrieve it");        
    }
    
    deleteShip(raw : HTMLElement) {
        let shipId = raw.getAttribute('data-ship-id');
        let data : Object = {};
        data['ship_id'] = shipId;

        $.ajax({
            url : System.getBaseUrl() + "/ship/remove",
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
        
    

    redirectToAddShip() {
        window.location.href = System.getBaseUrl() + "/ship/create";
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
