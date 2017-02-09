import {Component} from '../common/component';
import {AddSellingForm, AddSellingFormSuccessJson} from './add-selling-form';
import {DailySellingItem} from './daily-selling-item';


export class DailySellingView extends Component{
    asForm : AddSellingForm;

    area  : HTMLElement;

    items : DailySellingItem[];

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.asForm = new AddSellingForm(document.getElementById(this.id + "-asform"));
        this.area = <HTMLElement> this.root.getElementsByClassName('ds-view-area')[0];
        this.items = [];

        let itemsRaw : NodeListOf<Element> = this.root.getElementsByClassName('ds-item');

        for(let i = 0 ; i < itemsRaw.length; i++) {
            this.items.push(new DailySellingItem(<HTMLElement>itemsRaw.item(i)));
        }
    
    }
    
    bindEvent() {
        super.bindEvent();
        this.asForm.attachEvent(AddSellingForm.ADD_SELLING_FORM_SUCCESS, this.addNewDailyItem.bind(this));
    }

    addNewDailyItem(e) {
        let json : AddSellingFormSuccessJson = e.detail;
        let areaRaws : string = json.views;
        let div = document.createElement('div');
        div.innerHTML = areaRaws;
        let itemRaw : HTMLElement =  <HTMLElement> div.getElementsByClassName('ds-item')[0];
        this.area.appendChild(itemRaw);
        this.items.push(new DailySellingItem(itemRaw));
    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
