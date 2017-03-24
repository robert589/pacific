import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {Button} from './../common/button';
import {Validation} from './../common/validation';
import {CurrencyField} from './../common/currency-field';
import {SearchField} from './../common/search-field';

export class AddSellingForm extends Form{
    
    constructor(root: HTMLElement) {
        super(root);
        this.successCb = this.successCallback.bind(this);

    }

    successCallback(data) {
        let json : AddSellingFormSuccessJson = {
            views : data.views
        }
    
    }
    
    decorate() {
        super.decorate();
    }

    clickSwitch(e : Event) {
        e.preventDefault();
    }

    rules() {
    }

    validateFields() {
        // if(this.total.getValue() <= 0.00000001) {
        //     if( this.tonase.getValue() <= 0.0000001 ||
        //             this.price.getValue() <= 0.000001) {
        //         return false;
        //     }
        // }

        // return true
    }
    
    bindEvent() {
        super.bindEvent();
    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}


export interface  AddSellingFormSuccessJson {
    views : string
}
