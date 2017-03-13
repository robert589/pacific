import {Field} from './Field';
import {System} from './../common/system';

export class InputField extends Field {

    public static get VALUE_CHANGED() {return "INPUT_FIELD_VALUE_CHANGED"};

    protected inputElement : HTMLInputElement;

    private dateFormat : string  = 'dd-mm-yy';

    private valueChangeEvent : CustomEvent;

    private keyPressedEvent : CustomEvent;
    
    private type : string;
    
    constructor(root : HTMLElement) {
        super(root);
        this.type = this.inputElement.getAttribute("type");
            
    }

    decorate() {
        super.decorate();
        this.inputElement = <HTMLInputElement> 
                        this.root.getElementsByClassName('input-field-input')[0];
        if(!System.isEmptyValue(this.root.getAttribute('data-datepicker'))) {
            $("#" + this.id).find(".input-field-input")
                            .datepicker({dateFormat: "dd/mm/yy",
                                        changeMonth: true,
                                        changeYear: true,
                                        onSelect: function(date) {
                                            this.triggerValueChangedEvent();
                                        }.bind(this)
                                    });
        } else if(!System.isEmptyValue(this.root.getAttribute('data-timepicker'))) {
            $("#" + this.id).find(".input-field-input")
                            .timepicker({
                                change: function(time) {
                                    this.triggerValueChangedEvent();
                                }.bind(this)
                            });
        }
    }

    bindEvent() {
        super.bindEvent();
        this.valueChangeEvent = new CustomEvent(InputField.VALUE_CHANGED);

        this.inputElement.addEventListener('change', this.triggerValueChangedEvent.bind(this));
        if(this.type === "file") {
            this.inputElement.addEventListener('change click',
                        this.triggerValueChangedEvent.bind(this));
        }
    }


    triggerValueChangedEvent() {
        this.inputElement.setAttribute('value', this.inputElement.value);
        this.root.dispatchEvent(this.valueChangeEvent);
    }

    public attachInputElement(eventName : string, cb : () => void) {
        this.inputElement.addEventListener(eventName, cb);
    }

    detach() {
        this.inputElement = null;
    }

    unbindEvent() {
        
    }

    getValue() : Object {
        if(this.type === "file" ) {
            return this.inputElement.files[0];
        }
        return this.inputElement.value;
    }

    setValue(val : string) {
        this.inputElement.value = val;
    }

    getDateFormat() {
        return this.dateFormat;
    }

    disable() {
        this.inputElement.setAttribute('disabled', "true");
    }
    enable() {
        this.inputElement.removeAttribute('disabled');
    }

    setMax(max : number) {
        try {
            if(this.type !== "number" ) {
                throw new TypeError("Input field must be a number type");
            } else {
                this.inputElement.max = max + "";
            }
        } catch(e) {
            console.log((<Error> e).message );
        }
    }

    setMin(min : number ) {
        try {
            if(this.type !== "number" ) {
                throw new TypeError("Input field must be a number type");
            } else {
                this.inputElement.min = min + "";
            }
        } catch(e) {
            console.log((<Error> e).message );
        }

    }

    getSelectionStart() : number {
        return this.inputElement.selectionStart;
    }

    setSelectionStart(startPoint : number) : void {
        this.inputElement.selectionStart = startPoint;
    }

    setSelectionEnd(endPoint : number) : void { 
        this.inputElement.selectionEnd = endPoint;
    }
}
