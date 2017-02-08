import {Component} from './component';
import {System} from './system';

export class TabItem extends Component {
    

    constructor(root : HTMLElement) {
        super(root);
    }

    decorate() {
        super.decorate();
    }

    bindEvent() {
        super.bindEvent();
    }

    show() {

    }

    hide() {
        
    }
    
    getIndex() : number {
        return parseInt(this.root.getAttribute('data-index'));
    }
}