import {Component} from './component';
import {Button} from './../common/button';

export abstract class BtnContainer extends Component {

    constructor(root : HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
    }
    
    bindEvent() {
        super.bindEvent();
    }


}