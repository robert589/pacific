import {Component} from './component';

export class Button extends Component {
    
    constructor(root: HTMLElement, clickEvent : Function) {
        super(root);
        this.addClickEvent(clickEvent);
    }
    
    addClickEvent(cb : Function) {
        this.root.onclick = function(e) {
            if(!this.isDisabled()) {
                cb(e);
            }
        }.bind(this);

    }

    click() {
        this.root.click();
    }

    disable(on) {
        (<HTMLInputElement>this.root).disabled = on;
    }

    isDisabled() {
        return (<HTMLInputElement>this.root).disabled;
    }
    
    detach() {
        super.detach();
        this.root.onclick = null;
        this.root = null;
    }

    getText() : string {
        return this.root.innerHTML;
    }

    setText(text : string) {
        this.root.innerHTML = text;
    }
}