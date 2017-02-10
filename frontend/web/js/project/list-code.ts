import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class ListCode extends Component{

    addBtn  : Button;

    codeType : Button;

    constructor(root: HTMLElement) {
        super(root);
    }

    redirectToAdd() {
        window.location.href = System.getBaseUrl() + "/code/create";
    }

    redirectToCodeType() {
        window.location.href = System.getBaseUrl() + "/code/type";
    }
    
    decorate() {
        super.decorate();
        this.addBtn = new Button(document.getElementById(this.id + "-add"), this.redirectToAdd.bind(this));
        this.codeType = new Button(document.getElementById(this.id + "-codetype"), this.redirectToCodeType.bind(this));
        
    }
    
    bindEvent() {
        super.bindEvent();
   }
    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
