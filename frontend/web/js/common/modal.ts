import {Component} from './component';
import {Button} from './../common/button';

export abstract class Modal extends Component {
    closeButton : Button;

    title : HTMLElement;

    constructor(root : HTMLElement) {
        super(root);
    }
    
    public show() {
        this.root.classList.add('modal-show');
        this.root.classList.remove('modal-hide');
    }
    
    public hide() {
        this.root.classList.add('modal-hide');
        this.root.classList.remove('modal-show');
        
    }
    
    decorate() {
        super.decorate();
        this.title = <HTMLElement> this.root.getElementsByClassName('modal-title')[0];
        this.closeButton = new Button(<HTMLElement> document.getElementById(this.id + "-close-button"),
                                    function(e) {
                                        this.hide();
                                    }.bind(this));    
        
    }
    
    bindEvent() {
        super.bindEvent();
        this.root.addEventListener('click', function(e : Event) {
            if(e.target && !(<HTMLElement> e.target).closest('.modal-content') ) {
                this.hide();
            }   
        }.bind(this));
    }

    setTitle(title : string) {
        this.title.innerHTML = title;
    }

}