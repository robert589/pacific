import {Component} from '../common/component';
import {InfScrollItem} from './inf-scroll-item';
import {Button} from './button';

export abstract class InfScroll extends Component {
    
    protected items : InfScrollItem[];

    protected loadMoreBtn : Button;

    protected url : string;

    protected scrollValue : number;

    protected newArea : HTMLElement;

    protected totalArea : HTMLElement;

    protected reachedEndArea : HTMLElement;

    protected total : number;

    constructor(root : HTMLElement) {
        super(root);
        this.setValueInTotalArea(this.total - this.items.length);

    }

    abstract getData();

    decorate() {
        super.decorate();
        this.items = [];
        this.url = this.root.getAttribute('data-load-url');
        this.total = parseInt(this.root.getAttribute('data-total'));
        this.scrollValue = parseInt(this.root.getAttribute('data-scroll-value'));
        this.loadMoreBtn = new Button(document.getElementById(this.id + "-loadmore"), this.clickLoadMore.bind(this));
        this.newArea = <HTMLElement> this.root.getElementsByClassName('inf-scroll-new')[0];
        this.totalArea = <HTMLElement> this.root.getElementsByClassName('inf-scroll-total')[0];
        this.reachedEndArea = <HTMLElement> this.root.getElementsByClassName('inf-scroll-reached-end')[0];
    }

    bindEvent() {
        super.bindEvent();
    }

    clickLoadMore(e) {
        $.ajax({
            url: this.url,
            method: 'post',
            data: this.getData(),
            success: function(data) {
                let parsed = JSON.parse(data);
                if(parsed['status'] === 1) {
                    this.appendNewItems(parsed['views']);
                    this.substractValueInTotalArea(parseInt(parsed['total']));
                } else {
                    
                }   
            }.bind(this),
            error : function(data) {

            }
        })

    }

    appendNewItems(views : string) {
        this.newArea.innerHTML = views;
    }

    substractValueInTotalArea(value : number) {
        let curTotal : number = parseInt(this.totalArea.innerHTML);
        let newTotal : number = curTotal - value;
        this.totalArea.innerHTML = "" + newTotal;
        if(newTotal <= 0) {
            this.hideTotalArea();
        }
    }

    hideTotalArea() {
        this.loadMoreBtn.addClass('app-hide');
        this.reachedEndArea.classList.remove('app-hide');
    }

    setValueInTotalArea(value : number) {
        if(value <= 0) {
            this.hideTotalArea();
        } 
        this.totalArea.innerHTML = value + "";
        
    }
    

}
