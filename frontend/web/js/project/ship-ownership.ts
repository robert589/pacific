import {Component} from '../common/component';
import {SearchField} from './../common/search-field';
import {Button} from './../common/button';
import {System} from './../common/system';

export class ShipOwnership extends Component{

    ship : SearchField;

    owner : SearchField;

    add  : Button;

    area  : HTMLElement;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.ship = new SearchField(document.getElementById(this.id + "-ship"));
        this.area = <HTMLElement> this.root.getElementsByClassName('ship-owner-area')[0];
        this.owner = new SearchField(document.getElementById(this.id + "-owner"));
        this.add = new Button(document.getElementById(this.id + "-add"), this.assignShip.bind(this) );
    }

    assignShip() {
        let data : Object = {};
        data['ship_id'] = this.ship.getValue();
        data['owner_id'] = this.owner.getValue();
        data = System.addCsrf(data);
        this.add.disable(true);
        $.ajax({
            url : System.getBaseUrl()  + "/ship/assign",
            data : data,
            dataType : "json",
            context : this,
            method : "post",
            success : function(data) {
                this.add.disable(false);
                if(data.status) {
                    window.location.reload();
                }
            },
            error : function(data) {

            }
        })
    }

    enableOwnerField() {
        this.owner.enable();
        this.owner.resetValue();
        this.owner.emptyText();
    }

    getOwnershipGridview() {
         let data : Object = {};
         data['ship_id'] = this.ship.getValue();
         $.ajax({
            url : System.getBaseUrl()  + "/ship/get-ownership-gv",
            data : System.addCsrf(data),
            dataType : "json",
            context : this,
            method : "post",
            success : function(data) {
                this.add.disable(false);
                if(data.status) {
                    this.area.innerHTML = data.views;
                }
            },
            error : function(data) {

            }
        })
    }

    disableOwnerField() {
        this.owner.disable();
        this.owner.resetValue();
        this.owner.emptyText();
    }

    enableAddBtn() {
        this.add.disable(false);
    }

    disableAddBtn() {
        this.add.disable(true);
    }

    bindEvent() {
        super.bindEvent();
        this.ship.attachEvent(SearchField.GET_VALUE_EVENT, this.enableOwnerField.bind(this));
        this.ship.attachEvent(SearchField.GET_VALUE_EVENT, this.getOwnershipGridview.bind(this));
        this.ship.attachEvent(SearchField.LOSE_VALUE_EVENT, this.disableOwnerField.bind(this));
        this.owner.attachEvent(SearchField.GET_VALUE_EVENT, this.enableAddBtn.bind(this));
        this.owner.attachEvent(SearchField.LOSE_VALUE_EVENT, this.disableAddBtn.bind(this));
    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
