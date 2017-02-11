import {Field} from './field';
import {Validation} from './../common/validation';

export class EqualValidation extends Validation {

    private sourceField : Field;

    constructor(targetField : Field, sourceField : Field ) {
        super();
        this.targetField = targetField;
        this.sourceField = sourceField;
        this.errorMessage = this.sourceField.getDisplayName() + " and this field must be the same";
        this.validate = this.validateEquality.bind(this);
    }

    validateEquality() {
        return this.sourceField.getValue() === this.targetField.getValue();
    }
}