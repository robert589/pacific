import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class ListWarehouse extends Component{

    add : Button;

    editBtns : Button[];

    redirectToAddWarehouse() {
        window.location.href = System.getBaseUrl() + "/inventory/add-warehouse";
    }   

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.add = new Button(document.getElementById(this.id + "-add"), this.redirectToAddWarehouse.bind(this));

        this.editBtns = [];
        let editBtnsRaw : NodeListOf<Element> = this.root.getElementsByClassName('list-warehouse-edit');
        for(let i = 0; i < editBtnsRaw.length; i++) {
            this.editBtns.push(new Button(<HTMLElement>editBtnsRaw.item(i),
                                         this.redirectToEditPage.bind(this,<HTMLElement> editBtnsRaw.item(i))));
        }
    }

    redirectToEditPage(raw : HTMLElement) {
        let warehouseId : number = parseInt(raw.getAttribute('data-entity-id'));
        window.location.href = System.getBaseUrl() + "/inventory/edit-warehouse?id=" + warehouseId;
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
