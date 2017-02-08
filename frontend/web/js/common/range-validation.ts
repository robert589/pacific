import {Field} from './field';
import {Validation} from './../common/validation';

export class RangeValidation extends Validation {

    private min : number;

    private max : number;

    constructor(targetField : Field, min : number, max : number ) {
        super();
        this.targetField = targetField;
        this.min = min;
        this.max = max;
        this.errorMessage = this.getErrorMessage();
        this.validate = this.validateRange.bind(this);
    }

    getErrorMessage() : string {
        let message : string ;
        if(this.max !== null && this.min !== null) {
            message = 
            this.targetField.getDisplayName() + " must be in the range of " +
            this.min + " to " + this.max;
        } else if(this.min !== null) {
            message = this.targetField.getDisplayName() + " cannot be less than "
            + this.min;
        } else {
            message = this.targetField.getDisplayName() + " must be at most "
            + this.min;
        }

        return message;
    }

    validateRange() {
        let valid : boolean =  
            (this.min === null ||
                this.targetField.getValue() >= this.min) 
                && ( this.max === null ||
                    this.targetField.getValue() <= this.max);
        if(!valid) {
           this.targetField.showError(this.errorMessage);
        }
        return valid;
    }
}