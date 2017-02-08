import {Field} from './Field';
import {System} from './../common/system';

export class StarRatingField extends Field {
    
    public static get UNFILLED_STAR() { return "☆"};

    public static get FILLED_STAR() { return "★"};
    
    private starItems : HTMLElement[];

    private value : number; 

    constructor(root : HTMLElement) {
        super(root);
    }

    decorate() {
        super.decorate();
        this.starItems = [];
        let rawStarItems : NodeListOf<Element> = this.root.getElementsByClassName('sr-field-item');
        for(let i = 0; i < rawStarItems.length; i++) {
            this.starItems.push(<HTMLElement> rawStarItems.item(i));
        }
        
    }
    
    bindEvent() {
        super.bindEvent();

        //hover event
        document.addEventListener('mouseover', function(e) {
            if(e.target && (<HTMLElement> e.target).closest('.sr-field-item')) {
                let hoverValue : number = parseInt((<HTMLElement> e.target).getAttribute('data-index'));
                this.setView(hoverValue);
            } else if(e.target && !(<HTMLElement> e.target).closest('.sr-field-item')) {
                this.refreshView();
            }
        }.bind(this));

        //click event
        for(let i = 0; i < this.starItems.length; i++) {
            this.starItems[i].addEventListener('click', function(e) {
                this.setValue(parseInt((<HTMLElement>e.target).getAttribute('data-index')));
            }.bind(this));
        }

    }

    setView(index : number) {
        for(let i = 0; i < this.starItems.length; i++) {
            this.changeToUnfill(this.starItems[i]);
            if(parseInt(this.starItems[i].getAttribute('data-index')) <= index) {
                this.changeToFill(this.starItems[i]);
            } 
        }
    }

    refreshView() {
        this.setView((System.isEmptyValue(this.value) ? 0 : this.value));
    }

    changeToFill(element : HTMLElement) {
        element.classList.add('sr-field-select');
        element.innerHTML = StarRatingField.FILLED_STAR;
    }

    changeToUnfill(element : HTMLElement) {
        element.classList.remove('sr-field-select');
        element.innerHTML = StarRatingField.UNFILLED_STAR;
    }

    public getValue() : Object{
        return this.value;    
    }

    public setValue(value : number) {
        this.value = value;
        this.refreshView();
    }

}