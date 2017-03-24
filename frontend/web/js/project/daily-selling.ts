import {Component} from '../common/component';
import {SearchField} from './../common/search-field';
import {InputField} from './../common/input-field';
import {System} from './../common/system';
import {DailySellingView} from './daily-selling-view';
import {Button} from './../common/button';
import {AddSellingFormModal} from './add-selling-form-modal';

export class DailySelling extends Component{

    date : InputField;

    area : HTMLElement;

    sellingView : DailySellingView;

    asfModalBtn : Button;

    asfModal : AddSellingFormModal;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.date = new InputField(document.getElementById(this.id + "-date"));    
        this.area = <HTMLElement> this.root.getElementsByClassName('daily-selling-area')[0];
        this.asfModalBtn = new Button(document.getElementById(this.id + "-asf-modal-btn"), this.showModal.bind(this));
        this.asfModal = new AddSellingFormModal(document.getElementById(this.id + "-asf-modal"));
    }

    showModal() {
        this.asfModal.show();
    }
    
    bindEvent() {
        super.bindEvent();
        this.date.attachEvent(InputField.VALUE_CHANGED, this.getView.bind(this));
    }

    getView() {
        let data = {};
        data['date'] = this.date.getValue();
        this.area.innerHTML = "Loading . . .";
        this.asfModalBtn.disable(true);
        $.ajax({
            url : System.getBaseUrl() + "/selling/get-daily-selling-view",
            data :  System.addCsrf(data),
            context : this,
            dataType : "json",
            method : "post",
            success : function(data) {
                if(data.status) {
                    this.addViewToArea(data.views);
                    this.asfModalBtn.disable(false);
                }
            },
            error : function(data) {

            }
        })
    }

    addViewToArea(views : string) { 
        this.area.innerHTML  = "";

        if(!System.isEmptyValue(this.sellingView)) {
            this.sellingView.deconstruct();
        }

        let wrapper = document.createElement("div");
        wrapper.innerHTML = views;

        let sellingViewRaw : HTMLElement =  <HTMLElement> wrapper.getElementsByClassName('ds-view')[0];
        this.area.appendChild(sellingViewRaw);

        this.sellingView = new DailySellingView(sellingViewRaw);

    }

    enableDateField() {
        this.date.enable();
        this.date.setValue("");
    }

    disableDateField() {
        this.date.disable();
        this.date.setValue("");
    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }

}
