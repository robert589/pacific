import {Field} from './../common/field';
import {System} from './../common/system';
import {SearchFieldDropdownItem} from './search-field-dropdown-item';
import {Button} from './button';
import {KeyCode} from './key-code';
import {Math} from './math';

export class SearchField extends Field {

    public static get GET_VALUE_EVENT() {return "SEARCH_FIELD_GET_VALUE_EVENT"};

    public static get LOSE_VALUE_EVENT() {return "SEARCH_FIELD_LOSE_VALUE_EVENT"};

    url : string;

    input : HTMLInputElement;

    dropdown : HTMLElement;

    loading : HTMLElement;

    items : SearchFieldDropdownItem[];

    valueId : string;

    curText : string;

    additionalData : Object;

    getValueEvent: CustomEvent;

    resetBtn : Button;

    loseValueEvent : CustomEvent;

    private disabledItems : string[];

    constructor(root : HTMLElement) {
        super(root);
        this.additionalData = [];
        this.disabledItems = [];
        this.initValue();
    }


    decorate() {
        super.decorate();
        this.url = this.root.getAttribute('data-url');
        this.items = [];
        this.input = <HTMLInputElement> this.root.getElementsByClassName('search-field-input')[0];
        this.dropdown = <HTMLElement> this.root.getElementsByClassName('search-field-dropdown')[0];
        this.loading = <HTMLElement> this.root.getElementsByClassName('search-field-loading')[0];
        this.resetBtn = new Button(document.getElementById(this.id + "-reset"), this.reset.bind(this));
    }

    reset() {
        this.resetValue();
        this.emptyText();
    }

    bindEvent() {
        this.input.addEventListener('input', function(e) {
            this.sendAjax();
            if(this.curText !== this.input.value) {
                this.resetValue();
            }
        }.bind(this));


        this.input.addEventListener('click', function(e) {
            this.sendAjax();
        }.bind(this));
        
        this.getValueEvent = new CustomEvent(SearchField.GET_VALUE_EVENT);
        this.loseValueEvent = new CustomEvent(SearchField.LOSE_VALUE_EVENT);
        
        this.root.addEventListener('keydown', this.controlEvent.bind(this));

        document.addEventListener('click', function(e) {
            if(e.target && !(<HTMLElement> e.target).closest('.search-field-dropdown')) {
                this.emptyDropdown();
            }

            if(e.target && (<HTMLElement> e.target).closest('.search-field-input')) {
            }
            else if(e.target && !(<HTMLElement> e.target).closest('.search-field-input')) {
            }

        }.bind(this));

    }

    registerControlEvent() {
        this.root.addEventListener('keydown', this.controlEvent.bind(this));
    }

    controlEvent(e : KeyboardEvent) {
        if(e.which === KeyCode.DOWN_KEY) {
                this.searchDownDropdown();
            }
        else if(e.which === KeyCode.UP_KEY) {
            this.searchUpDropdown();
        }
        else if(e.which === KeyCode.ENTER_KEY) {
            e.preventDefault();
            this.selectHoverDropdown();
        }
    }

    deregisterControlEvent() {
        this.root.removeEventListener('keydown', this.controlEvent.bind(this));
    }

    searchDownDropdown() {
        if(this.items.length === 0) {
            return;
        }
        
        for(let i = 0; i < this.items.length; i++) {
            if(this.items[i].hasClass("sfdi-hover")) {
                this.items[i].removeClass("sfdi-hover");
                this.items[Math.modulo((i + 1) , this.items.length)].addClass("sfdi-hover");
                return;
            }
        }

        this.items[0].addClass("sfdi-hover");
    }

    searchUpDropdown() {
        if(this.items.length === 0 ) {
            return;
        }

        for(let i = 0; i < this.items.length; i++) {
            if(this.items[i].hasClass("sfdi-hover")) {
                this.items[i].removeClass("sfdi-hover");
                this.items[Math.modulo((i - 1) , this.items.length)].addClass("sfdi-hover");
                return;
            }
        }

        this.items[this.items.length - 1].addClass("sfdi-hover");
    }

    selectHoverDropdown() {
        for(let i = 0; i < this.items.length; i++) {
            if(this.items[i].hasClass("sfdi-hover")) {
                this.items[i].releaseEvent("click");
            }
        }
        this.emptyDropdown();
    }

    resetValue() {
        this.curText = null;
        this.valueId = null;
        this.input.classList.remove('selected');
        this.root.dispatchEvent(this.loseValueEvent);
    }

    emptyText() {
        this.input.value = null;
    }

    emptyDropdown() {
        this.hideDropdown();
        this.dropdown.innerHTML = null;
        let i : number = 0;
        for(i = 0; i < this.items.length; i++) {
            this.items[i].deconstruct();
        }
        this.items = [];
    }

    setAdditionalData(data : Object) {
        this.additionalData = data;
    }

    showLoading() {
        this.loading.classList.remove('app-hide');
    }

    hideLoading() {
        this.loading.classList.add('app-hide');
    }

    sendAjax() {
        this.showLoading();
        let data : Object = {};
        data['q'] = this.input.value;
        data['id'] = this.id;
        //merge
        for (let attrname in this.additionalData) { 
            data[attrname] = this.additionalData[attrname]; 
        }
        System.addCsrf(data);
        $.ajax ({
            url : this.url,
            method: 'get',
            context : this,
            data: data,
            success : function(data) {
                this.hideLoading();
                var parsed = JSON.parse(data);
                if(parsed.status === 1) {
                    this.emptyDropdown();
                    this.setDropdown(parsed.views);
                }
            },
            error : function() {
                this.hideLoading();
            }
        });
    }

    initValue() {
        /**
         * Need improvement
         */
        if(!System.isEmptyValue(this.input.value)) {
            let index = this.root.getAttribute('data-index');
            let id : string = (System.isEmptyValue(index)) ? this.input.value : index;
            this.setValue(id, this.input.value);
        }
    }

    setDropdown(views : string) {
        this.emptyDropdown();
        this.dropdown.innerHTML = views;
        let results : NodeListOf<Element> = this.dropdown.getElementsByClassName('sfdi');
        let  i : number;
        for( i = 0 ; i < results.length; i++) {
            this.items.push(new SearchFieldDropdownItem(<HTMLElement> results.item(i)));
            if(this.disabledItems.indexOf( this.items[i].getItemId() + "") !== -1) {
                this.items[i].disabled(true);
            }
            this.items[i].attachEvent(SearchFieldDropdownItem.CLICK_SFDI_EVENT,function(e) {
                this.setValue(e.detail.itemId, e.detail.text);
                this.hideDropdown();
            }.bind(this));
            this.items[i].attachEvent(SearchFieldDropdownItem.HOVER_SFDI_EVENT, 
                            this.removeHoverExcept.bind(this));
            }
        this.showDropdown();
    }

    removeHoverExcept(e) {
        let itemId : string = <string> e.detail.itemId;

        for(let i = 0; i < this.items.length; i++) {
            if(this.items[i].hasClass("sfdi-hover") && 
                this.items[i].getItemId() !== itemId) {
                this.items[i].removeClass("sfdi-hover");
            }
        }
    }

    hideDropdown() {
        this.dropdown.classList.add('app-hide');
    }

    showDropdown() {
        this.dropdown.classList.remove('app-hide');
    }

    setValue(id : string, text : string) {
        (<HTMLInputElement> this.input).value = text;
        this.valueId = id;
        this.curText = text;
        this.input.classList.add('selected');
        this.root.dispatchEvent(this.getValueEvent);
    }

    getValue() : Object {
        return this.valueId;
    }

    getCurText() : string {
        return this.curText;
    }

    disable() {
        this.input.setAttribute('disabled', "true");
    }
    enable() {
        this.input.removeAttribute('disabled');
    }

    disableItem(id : string) {
        this.disabledItems.push(id);
    }

    enableItem(id : string) {
        let index : number = this.disabledItems.indexOf(id);    
        if(index > -1) {
            this.disabledItems.splice(index, 1);
        }
    }

    clearDisabledItems() {
        this.disabledItems = [];
    }
}