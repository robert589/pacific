import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {Button} from './../common/button';
import {Validation} from './../common/validation';
import {CurrencyField} from './../common/currency-field';
import {SearchField} from './../common/search-field';
import {System} from './../common/system';

export class AddSellingForm extends Form    {
    
    dateField : InputField;

    productField : SearchField;

    priceField : CurrencyField;

    unitField : InputField;

    totalField : CurrencyField;

    buyerField  :SearchField;

    warehouseField : SearchField;

    remarkField : InputField;

    statusEl : HTMLElement;

    constructor(root: HTMLElement) {
        super(root);
        this.failCb = this.failCallback.bind(this);
        this.successCb = this.successCallback.bind(this);
    }

    failCallback() {
        this.setStatus("Error!");
        this.setStatusClass("as-form-error");
    }

    successCallback(data) {
        let json : AddSellingFormSuccessJson = {
            views : data.views
        }
        this.productField.reset();
        this.setStatus("Success!");
        this.setStatusClass("as-form-success");
    }
    
    decorate() {
        super.decorate();
        this.dateField = new InputField(document.getElementById(this.id + "-date"));
        this.productField = new SearchField(document.getElementById(this.id + "-product"));
        this.priceField = new CurrencyField(document.getElementById(this.id + "-price"));
        this.unitField=  new InputField(document.getElementById(this.id + "-unit"));
        this.totalField = new CurrencyField(document.getElementById(this.id + "-total"));
        this.buyerField = new SearchField(document.getElementById(this.id + "-buyer"));
        this.warehouseField = new SearchField(document.getElementById(this.id + "-warehouse"));
        this.remarkField = new InputField(document.getElementById(this.id + "-remark"));

        this.statusEl = <HTMLElement> this.root.getElementsByClassName('as-form-status')[0];
    }

    setStatus(name : string) {
        this.statusEl.innerHTML = name;
    }

    setStatusClass(className : string) {
        this.statusEl.classList.add(className);
    }

    clickSwitch(e : Event) {
        e.preventDefault();
    }

    rules() {
        this.setRequiredField([this.dateField, 
                        this.productField, this.priceField, this.unitField]);
        this.registerFields([this.dateField, this.productField, this.priceField, this.unitField,
                                this.buyerField, this.warehouseField, this.remarkField]);
    }
    
    bindEvent() {
        super.bindEvent();
        this.productField.attachEvent(SearchField.GET_VALUE_EVENT, this.enablePriceField.bind(this));
        this.productField.attachEvent(SearchField.GET_VALUE_EVENT, this.enableUnitField.bind(this));
        this.productField.attachEvent(SearchField.GET_VALUE_EVENT, this.isEntityInInventory.bind(this));

        this.productField.attachEvent(SearchField.LOSE_VALUE_EVENT, this.disablePriceField.bind(this));
        this.productField.attachEvent(SearchField.LOSE_VALUE_EVENT, this.disableUnitField.bind(this));
        this.productField.attachEvent(SearchField.LOSE_VALUE_EVENT, this.disableWarehouse.bind(this));

        this.unitField.attachEvent(InputField.VALUE_CHANGED, this.calculateTotalField.bind(this));
        this.priceField.attachEvent(CurrencyField.VALUE_CHANGED, this.calculateTotalField.bind(this));
    }

    calculateTotalField() {
        let price : number = this.priceField.getValue();        
        let unit : number = <number>this.unitField.getValue();

        if(System.isEmptyValue(price) || System.isEmptyValue(unit)) {
            this.totalField.setValue(0);
            return;   
        }

        let total : number = price * unit;
        this.totalField.setValue(total);        
    }

    resetStatus() {
        this.setStatus("");
        this.statusEl.classList.remove("as-form-success");
        this.statusEl.classList.remove("as-form-error");
    }
    

    isEntityInInventory() {
        let data = {};
        data['entity_id'] = this.productField.getValue();
        data = System.addCsrf(data);

        $.ajax({
            url : System.getBaseUrl() + "/inventory/in-inventory",
            method : "post",
            context : this,
            dataType : "json",
            data : data,
            success : function(data) {
                if(data.status && data.in) {
                    this.enableWarehouse();
                } else {
                    this.disableWarehouse();
                }
            },
            error : function(data) {

            }
        })
    }

    enableWarehouse() {
        this.warehouseField.enable();
        this.warehouseField.reset();
    }

    disableWarehouse() {
        this.warehouseField.disable();
        this.warehouseField.reset();    
    }

    enablePriceField() {
        this.priceField.enable();
        this.priceField.emptyValue();
    }

    disablePriceField() {
        this.priceField.disable();  
        this.priceField.emptyValue();
        this.calculateTotalField();
    }

    enableUnitField() {
        this.unitField.enable();
        this.unitField.setValue("0");
    }

    disableUnitField() {
        this.unitField.disable();
        this.unitField.setValue("0");
        this.calculateTotalField();
    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }

    setDate(date : string) {
        this.dateField.setValue(date);
    }
}


export interface  AddSellingFormSuccessJson {
    views : string
}
