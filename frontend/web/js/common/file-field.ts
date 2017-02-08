import {Field} from './Field';

export class FileField extends Field {

    public static get CHANGE_INPUT_EVENT() {return "FF_CHANGE_INPUT_EVENT"};

    protected inputElement : HTMLInputElement;

    previewImg : HTMLElement;

    clickableImg : HTMLElement;
    
    changeInputEvent : CustomEvent;

    constructor(root : HTMLElement) {
        super(root);
    }

    decorate() {
        super.decorate();
        this.inputElement = <HTMLInputElement> this.root.getElementsByClassName('file-field-hi')[0];
        this.previewImg = <HTMLElement> this.root.getElementsByClassName('file-field-img')[0];
        this.clickableImg = <HTMLElement> this.root.getElementsByClassName('file-field-lbl')[0];
    }

    bindEvent() {
        this.changeInputEvent = new CustomEvent(FileField.CHANGE_INPUT_EVENT);
        this.inputElement.addEventListener('change', this.changeInput.bind(this));
    }

    changeInput(e) {
         if (e.target.files && e.target.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                this.setPreviewImage(e.target.result);
            }.bind(this);

            reader.readAsDataURL(e.target.files[0]);
        }

        this.root.dispatchEvent(this.changeInputEvent);
    }

    setPreviewImage(result) {
        this.previewImg.setAttribute('src', result);
        this.previewImg.classList.remove('app-hide');
        this.clickableImg.classList.add('app-hide');
    }

    validate() {

    }
    detach() {
        this.inputElement = null;
    }

    unbindEvent() {
        
    }

    getValue() : Object {
        return this.inputElement.files[0];
    }
}