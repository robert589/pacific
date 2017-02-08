import {Component} from './component';
import {Field} from './field';
import {System} from './system';
import {Validation} from './validation';
import {Button} from './../common/button';
import {RangeValidation} from './../common/range-validation';

export abstract class Form extends Component {

    url : string;

    method: string;

    successCb : any;

    failCb : any;

    file : boolean;

    private requiredFields : Field[];

    private allFields : Field[];

    private rangeValidations : RangeValidation[];
    
    emailFields : Field[];

    validations : Validation[];

    protected submitButton : Button;

    enableSubmit : number = 0;

    constructor(root : HTMLElement) {
        super(root);
        this.rules();
    }

    decorate() {
        super.decorate();
        //init variable
        this.requiredFields = [];
        this.allFields = [];
        this.emailFields = [];
        this.rangeValidations = [];
        this.validations = [];
        this.method = this.root.getAttribute('method');
        this.url = this.root.getAttribute('url');
        this.file = Boolean(this.root.getAttribute('data-file'));
        this.submitButton = new Button(document.getElementById(this.id + "-submit-btn"), 
                                        this.submit.bind(this));
    
    }

    bindEvent() {
        super.bindEvent();
        this.root.onsubmit = function(e) {
            return false;
        };

        this.root.onkeypress = function(e) {
            if(e.keyCode === 13) {
                this.submit(e);
            }
        }.bind(this);
    }

    abstract rules() : void;

    protected registerFields(fields : Field[]) {
        this.allFields = this.allFields.concat(fields);
    }

    protected setRequiredField(fields : Field[]) {
        this.requiredFields = this.requiredFields.concat(fields);
    }

    protected setRangeValidations(validations : RangeValidation[]) {
        this.rangeValidations = this.rangeValidations.concat(validations);
    }

    protected setValidations(validations : Validation[]) {
        this.validations = this.validations.concat(validations);
    }

    setEmailField(fields : Field[]) {
        this.emailFields = this.emailFields.concat(fields);
    }


    validate() : boolean {
        this.hideAllErrors();

        let valid : boolean = true;
        
        //validate required fields
        for(let field of this.requiredFields) {
            if(System.isEmptyValue(field.getValue())) {
                field.showError(field.getDisplayName() + " is required");
                valid = false;
            }
        }

        //validate email fields
        for(let field of this.emailFields) {
            if(!System.isEmail(<string> field.getValue())) {
                field.showError("The input must be a valid email address");
                valid = false;
            }
        }
        //execute range validations
        for(let validation of this.rangeValidations) {
            if(!validation.validate()) {
                valid = false;
            }
        }

        //execute all validations
        for(let validation of this.validations) {
            if(!validation.validate()) {
                validation.targetField.showError(validation.errorMessage);
                valid = false;
            }
        }

        return valid;
    }

    private hideAllErrors() : void {
        for(let field of this.allFields) {
            field.hideError();
        }
    
    }

    getJson(sendCsrf : boolean ) : JSON{
        let data : Object = {};

        if(sendCsrf) {
            data = System.addCsrf(data);
        }
        for(let field of this.allFields) {
            data[field.getName()] = field.getValue();
        }

        return <JSON> data;
    }

    submit(e) {
        e.preventDefault();
        
        if(this.enableSubmit !== 0) {
            return false;
        }

        var valid = this.validate();
        if(valid) {
            this.sendToServerSide();
        }

        return false;
    }


    sendToServerSide() {
        this.submitButton.disable(true);
        
        let ajaxSettings : JQueryAjaxSettings = {
            url : this.file ? System.addCsrfToUrl(this.url) : this.url,
            type: this.method,
            context : this,
            data : this.getJson(true),
            success : function(data) {
                var parsed = JSON.parse(data);
                if(parsed['status'] === 1) {
                    this.successCb(parsed);
                } else {
                    if(!System.isEmptyValue(parsed['errors'])) {
                        this.handleErrors(parsed['errors']);
                    }
                }   
                this.submitButton.disable(false);

            },
            error : function() {
                this.submitButton.disable(false);
            }
        };
        if(this.file) {
            ajaxSettings['processData'] = false;
            ajaxSettings['cache'] = false;
            ajaxSettings['contentType'] = false;
        }
        $.ajax (ajaxSettings);
    }

    handleErrors(errors : Object) {
        for(let field of this.allFields) {
            if(!System.isEmptyValue(errors[field.getName()])) {
                field.showError(errors[field.getName()][0]);
            } 
        }
    }

    findField(name : String) : Field{
        for(let field  of this.allFields) {
            if(field.getName() === name) {
                return field;
            }
        }
    }
}