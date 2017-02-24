import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {RangeValidation} from './../common/range-validation';
import {Validation} from './../common/validation';

export class AddEntityRelationRangeForm extends Form{

    fromField : InputField;

    toField : InputField;

    code : InputField;

    rules() {
        this.setRequiredField([this.fromField, this.toField, this.code]);
        this.registerFields([this.fromField, this.toField, this.code]);

        let validation1 : RangeValidation = new RangeValidation(this.fromField, 1, null);
        let validation2 : RangeValidation = new RangeValidation(this.toField, 1, null);
        this.setRangeValidations([validation1, validation2]);

        let validation : Validation = {
            "errorMessage" : "Field 'Dari' harus tidak lebih besar dari Field 'Sampai' ",
            "targetField" : this.toField,
            "validate" : function() {
                return this.fromField.getValue() >= this.toField.getValue();
            }.bind(this)
        }
    }
    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.fromField = new InputField(document.getElementById(this.id + "-from"));
        this.toField = new InputField(document.getElementById(this.id + "-to"));
        this.code = new InputField(document.getElementById(this.id + "-code"));
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
