import {Component} from './component';
import {Button} from './../common/button';

export abstract class BtnContainer extends Component {

    showBtn : Button;

    area : HTMLElement;

    constructor(root : HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.showBtn = new Button(document.getElementById(this.id + "-btn"), this.show.bind(this));
        this.area = <HTMLElement> this.root.getElementsByClassName('btnc-area')[0];
    }

    show() {
        this.area.classList.remove('app-hide');
    }

    hide() {
        this.area.classList.add('app-hide');
    }
    
    bindEvent() {
        super.bindEvent();
        document.addEventListener('click', function(e : Event) {
            if(e.target && !(<HTMLElement> e.target).closest("#" + this.getId())) {
                this.hide();
            }
        }.bind(this));
    }


}