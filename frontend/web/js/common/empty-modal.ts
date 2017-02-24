import {Modal} from './modal';
import {System} from './../common/system';
import {Button} from './../common/button';

export class EmptyModal extends Modal {

    contentEl : HTMLElement;

    constructor(root : HTMLElement) {
        super(root);
        this.setContent("Loading...");

    }

    decorate() {
        super.decorate();
        this.contentEl = <HTMLElement> this.root.getElementsByClassName('emodal-content')[0];
    }

    setContent(text : string) {
        this.contentEl.innerHTML = text;
    }


    bindEvent() {
        super.bindEvent();
    
    }

    detach() {
    }
}