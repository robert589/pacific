import {Field} from './field';

export class Validation {
    errorMessage : string;

    validate : () => boolean;

    targetField : Field;
}