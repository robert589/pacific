import {Modal} from './../common/modal';
import {System} from './../common/system';
import {Button} from './../common/button';
import {AddEntityRelationForm} from './add-entity-relation-form';
import {AddEntityRelation} from './add-entity-relation';

export class AddEntityRelationModal extends Modal {

    contentEl : HTMLElement;

    aer : AddEntityRelation;

    constructor(root : HTMLElement) {
        super(root);
        this.setContent("Loading...");

    }

    decorate() {
        super.decorate();
        this.contentEl = <HTMLElement> this.root.getElementsByClassName('aermodal-content')[0];
    }

    setForm(text : string) {
        if(!System.isEmptyValue(this.aer)) {
            this.aer.deconstruct();
        }
        let div : HTMLElement = document.createElement('div');
        div.innerHTML = text;
        let aerRaw : HTMLElement = <HTMLElement> div.getElementsByClassName('aer')[0];

        this.contentEl.appendChild(aerRaw);
        this.aer = new AddEntityRelationForm(aerRaw);
    }

    private setContent(text : string) {
        this.contentEl.innerHTML = text;
    }


    bindEvent() {
        super.bindEvent();
    
    }

    detach() {
    }
}