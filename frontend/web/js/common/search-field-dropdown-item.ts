import {Component} from './../common/component';

export class SearchFieldDropdownItem extends Component {
    
    public static get CLICK_SFDI_EVENT() : string {return  "CLICK_SFDI_EVENT"};

    clickSfdiEvent : CustomEvent;

    itemId: string;

    text : string;

    constructor(root : HTMLElement) {
        super(root);
    }

    decorate() {
        super.decorate();
        this.text = this.root.getAttribute("data-text");
        this.itemId = this.root.getAttribute("data-itemId");
    }

    bindEvent() {
        super.bindEvent();
        let sfdiJson : SfdiJson = {
            text : this.text,
            itemId : this.itemId
        }
        this.clickSfdiEvent = new CustomEvent(SearchFieldDropdownItem.CLICK_SFDI_EVENT, 
                                   {detail : sfdiJson});    
        this.root.addEventListener("click", function(e : Event) {
            this.root.dispatchEvent(this.clickSfdiEvent);
        }.bind(this));
    }

    unbindEvent() {
        this.root.addEventListener(SearchFieldDropdownItem.CLICK_SFDI_EVENT, null);
        this.root.addEventListener("click", null);
    }
}

interface SfdiJson {
    text : string;
    itemId : string;
}