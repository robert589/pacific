import {Component} from './component';
import {Field} from './field';
import {System} from './system';
import {Validation} from './validation';
import {Button} from './../common/button';
import {RangeValidation} from './../common/range-validation';
import {TabItem} from './tab-item';

export class TabContainer extends Component {

    tabHeaderItems : HTMLElement[];

    tabItems : TabItem[];

    constructor(root : HTMLElement) {
        super(root);

        //CHECK Active index
        let activeIndex : number = parseInt(this.root.getAttribute('data-active-index'));
        this.showTabItem(activeIndex);
    }

    decorate() {
        super.decorate();
        this.tabHeaderItems = [];
        this.tabItems = [];
        
        //decorate tab container header item
        let tabHeaderItemsRaw : NodeListOf<Element> = this.root.getElementsByClassName('tab-container-header-item');
        for(let i = 0 ; i < tabHeaderItemsRaw.length; i++) {
            this.tabHeaderItems.push(<HTMLElement> tabHeaderItemsRaw.item(i));
        }

        //decorate tab items
        let tabItemsRaw : NodeListOf<Element> = this.root.getElementsByClassName('tab-item');
        let element : HTMLElement;
        for(let i = 0 ; i < tabItemsRaw.length; i++) {
            element = <HTMLElement> document.getElementById(tabItemsRaw.item(i).getAttribute('id'));
            this.tabItems.push(new TabItem(element));
        }


    }

    bindEvent() {
        super.bindEvent();
        for(let i = 0 ; i < this.tabHeaderItems.length; i++) {
            this.tabHeaderItems[i].addEventListener('click', this.clickTabHeaderItem.bind(this));
        }
    }

    clickTabHeaderItem(e) {
        let index : number = parseInt((<HTMLElement>e.target).getAttribute('data-index'));
        this.showTabItem(index);
    }

    showTabItem(index : number) {
        let curIndexHeader : number;
        let curIndexBody : number;

        for(let i = 0; i < this.tabHeaderItems.length; i++) {
            curIndexHeader = parseInt(this.tabHeaderItems[i].getAttribute('data-index'));
            if(curIndexHeader === index) {
                this.tabHeaderItems[i].classList.add('active');
            } else {
                this.tabHeaderItems[i].classList.remove('active');
            }
        }
        for(let i = 0; i < this.tabItems.length; i++) {
            curIndexBody = this.tabItems[i].getIndex();
            if(curIndexBody === index) {
                this.tabItems[i].removeClass('app-hide')
            } else {
                this.tabItems[i].addClass('app-hide');
            }
        }
    }
   
}