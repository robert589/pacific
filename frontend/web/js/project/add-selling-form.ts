import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {Button} from './../common/button';
import {Validation} from './../common/validation';
import {CurrencyField} from './../common/currency-field';
import {SearchField} from './../common/search-field';

export class AddSellingForm extends Form{
    
    public static get ADD_SELLING_FORM_SUCCESS() { return "addsellingformsuccess"};

    successEvent : CustomEvent;

    remark : InputField;

    price : CurrencyField;

    tonase : InputField;

    total : CurrencyField;

    totalField : HTMLElement;

    remarkField : HTMLElement;

    priceField : HTMLElement;

    tonaseField : HTMLElement;

    productIF : InputField;

    buyerSF : SearchField;

    date : InputField;

    switch : Button;    

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = this.successCallback.bind(this);

    }

    successCallback(data) {
        let json : AddSellingFormSuccessJson = {
            views : data.views
        }
        this.successEvent = new CustomEvent(AddSellingForm.ADD_SELLING_FORM_SUCCESS,
                        {detail : json});
        this.root.dispatchEvent(this.successEvent);

        this.price.emptyValue();
        this.tonase.setValue("0");
        this.total.emptyValue();
        this.buyerSF.reset();
   
    }
    
    decorate() {
        super.decorate();
        this.productIF = new InputField(document.getElementById(this.id + "-product"));
        this.buyerSF = new SearchField(document.getElementById(this.id + "-buyer"));
        this.date = new InputField(document.getElementById(this.id + "-date"));
        this.remark = new InputField(document.getElementById(this.id + "-remark"));
        this.price = new CurrencyField(document.getElementById(this.id + "-price"));
        this.tonase = new InputField(document.getElementById(this.id + "-tonase"));
        this.total = new CurrencyField(document.getElementById(this.id + "-total"));

        this.switch = new Button(document.getElementById(this.id + "-switch"), this.clickSwitch.bind(this));

        this.totalField = <HTMLElement> document.getElementById(this.id + "total-el");
        this.priceField = <HTMLElement> document.getElementById(this.id + "price-el");
        this.tonaseField = <HTMLElement> document.getElementById(this.id + "tonase-el");
        
    }

    clickSwitch(e : Event) {
        e.preventDefault();
        if(this.totalField.classList.contains('app-hide')) {
            this.totalField.classList.remove('app-hide');
            this.priceField.classList.add('app-hide');
            this.tonaseField.classList.add('app-hide');
        } else {
            this.totalField.classList.add('app-hide');
            this.priceField.classList.remove('app-hide');
            this.tonaseField.classList.remove('app-hide');

        }

        this.total.emptyValue();
        this.price.emptyValue();
        this.tonase.setValue("0");
    }

    rules() {
        this.setRequiredField([this.total, this.price, this.tonase, this.date, this.productIF]);
        this.registerFields([this.total, this.price, this.tonase, this.buyerSF,
                    this.date, this.productIF, this.remark]);
        let validation : Validation = {
            errorMessage : "Total price atau (harga dan tonase) harus diisi",
            validate : this.validateFields.bind(this),
            targetField : this.total
        }
        let validation1 : Validation = {
            errorMessage : "Total price atau (harga dan tonase) harus diisi",
            validate : this.validateFields.bind(this),
            targetField : this.tonase
        }
        this.setValidations([validation, validation1]);
    }

    validateFields() {
        if(this.total.getValue() <= 0.00000001) {
            if( this.tonase.getValue() <= 0.0000001 ||
                    this.price.getValue() <= 0.000001) {
                return false;
            }
        }

        return true
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
