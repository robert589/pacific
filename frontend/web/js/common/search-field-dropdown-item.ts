import {Component} from './../common/component';

export class SearchFieldDropdownItem extends Component {
    
    public static get CLICK_SFDI_EVENT() : string {return  "CLICK_SFDI_EVENT"};

    public static get HOVER_SFDI_EVENT() : string {return "HOVER_SFDI_EVENT"};

    clickSfdiEvent : CustomEvent;

    hoverSfdiEvent : CustomEvent;

    itemId: string;

    text : string;

    constructor(root : HTMLElement) {
        super(root);
    }

    getItemId() : string {
        return this.itemId;
    }

    getText() : string {
        return this.text;
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

        this.hoverSfdiEvent = new CustomEvent(SearchFieldDropdownItem.HOVER_SFDI_EVENT,
                                    {detail : sfdiJson});
        this.root.addEventListener("click", this.dispatchClickSfdiEvent.bind(this));

        this.root.addEventListener("mouseover", this.addHoverClass.bind(this));
        this.root.addEventListener("mouseout", this.removeHoverClass.bind(this));
    }

    dispatchClickSfdiEvent() {
        this.root.dispatchEvent(this.clickSfdiEvent);
    }

    addHoverClass() {
        this.root.dispatchEvent(this.hoverSfdiEvent);
        this.addClass("sfdi-hover");
    }

    removeHoverClass() {
        this.removeClass("sfdi-hover");
    }

    unbindEvent() {
        this.root.addEventListener("mouseover", this.addHoverClass.bind(this));
        this.root.addEventListener("mouseout", this.removeHoverClass.bind(this));
        this.root.addEventListener("click", this.dispatchClickSfdiEvent.bind(this));
    }

    disabled(on : boolean) {
        if(on) {
            this.root.classList.add('disabled');
        } else {
            this.root.classList.remove('disabled');
        }
    }
}

interface SfdiJson {
    text : string;
    itemId : string;
}