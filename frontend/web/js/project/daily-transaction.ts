import {Component} from '../common/component';
import {SearchField} from './../common/search-field';
import {InputField} from './../common/input-field';
import {System} from './../common/system';
import {DailyTransactionView} from './daily-transaction-view';
import {Button} from './../common/button';

export class DailyTransaction extends Component{

    date : InputField;

    area : HTMLElement;

    transactView : DailyTransactionView;

    refresh : Button;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.date = new InputField(document.getElementById(this.id + "-date"));    
        this.area = <HTMLElement> this.root.getElementsByClassName('daily-transact-area')[0];
        this.refresh = new Button(document.getElementById(this.id + "-refresh"), this.getView.bind(this));

    }
    
    bindEvent() {
        super.bindEvent();
        this.date.attachEvent(InputField.VALUE_CHANGED, this.getView.bind(this));
    }

    getView() {
        let data = {};
        data['date'] = this.date.getValue();
        this.area.innerHTML = "Loading . . .";
        this.refresh.disable(true);
        $.ajax({
            url : System.getBaseUrl() + "/transaction/get-daily-view",
            data :  System.addCsrf(data),
            context : this,
            dataType : "json",
            method : "post",
            success : function(data) {
                if(data.status) {
                    this.addViewToArea(data.views);
                    this.refresh.disable(false);
                }
            },
            error : function(data) {

            }
        })
    }

    addViewToArea(views : string) { 
        this.area.innerHTML  = "";

        if(!System.isEmptyValue(this.transactView)) {
            this.transactView.deconstruct();
        }

        let wrapper = document.createElement("div");
        wrapper.innerHTML = views;

        let transactViewRaw : HTMLElement =  <HTMLElement> wrapper.getElementsByClassName('dt-view')[0];
        this.area.appendChild(transactViewRaw);

        this.transactView = new DailyTransactionView(transactViewRaw);

    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
