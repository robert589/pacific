import {Form} from '../common/form';
import {SearchField} from './../common/search-field';
import {InputField} from './../common/input-field';
import {RangeValidation} from './../common/range-validation';
import {CurrencyField} from './../common/currency-field';

export class AddPurchaseForm extends Form{

    codeField : SearchField;

    dateField : InputField;

    quantityField : InputField;

    costField : CurrencyField;

    expiryDateField : InputField;

    warehouseField : SearchField;

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.reload();
        }
    }
    
    decorate() {
        super.decorate();
        this.codeField = new SearchField(document.getElementById(this.id + "-code"));
        this.dateField = new InputField(document.getElementById(this.id+ "-date"));
        this.quantityField = new InputField(document.getElementById(this.id + "-quantity"));
        this.costField = new CurrencyField(document.getElementById(this.id + "-cost"));
        this.expiryDateField = new InputField(document.getElementById(this.id + "-expiry-date"));
        this.warehouseField = new SearchField(document.getElementById(this.id + "-warehouse"));
    }
    
    bindEvent() {
        super.bindEvent();
    }

    rules() {
        this.registerFields([this.codeField, this.dateField, this.quantityField,
                    this.warehouseField,
                    this.costField, this.expiryDateField]);

        this.setRequiredField([this.codeField, this.dateField, this.quantityField,
                    this.warehouseField,
                    this.costField, this.expiryDateField]);

        let rangeValidation : RangeValidation = new RangeValidation(this.costField, 0, null);
        this.setRangeValidations([rangeValidation]);

    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
