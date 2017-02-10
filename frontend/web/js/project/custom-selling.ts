import {Component} from '../common/component';
import {CustomSellingForm, CustomSellingFormSuccessJson} from './custom-selling-form';
import {SellingView} from './selling-view';

export class CustomSelling extends Component{

    form : CustomSellingForm;
    
    area : HTMLElement;

    sellingView : SellingView;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new CustomSellingForm(document.getElementById(this.id + "-form"));
        this.area = <HTMLElement> this.root.getElementsByClassName('custom-selling-area')[0];
    }
    
    bindEvent() {
        super.bindEvent();
        this.form.attachEvent(CustomSellingForm.SUCCESS_EVENT, this.addArea.bind(this))
    }

    addArea(e) {
        if(this.sellingView) {
            this.sellingView.deconstruct();
        }
        this.area.innerHTML = "";
        let json : CustomSellingFormSuccessJson = e.detail;
        let div : HTMLElement = document.createElement('div');
        div.innerHTML = json.views;
        let sellingViewRaw : HTMLElement = <HTMLElement> div.getElementsByClassName('selling-view')[0];
        this.area.appendChild(sellingViewRaw);
        this.sellingView = new SellingView(sellingViewRaw);
    }

}
