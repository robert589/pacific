import {Component} from '../common/component';
import {Modal} from './../common/modal';
import {Button} from './../common/button';
import {LoginForm} from './login-form';

export class Login extends Component{

    loginForm : LoginForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.loginForm = new LoginForm(document.getElementById(this.id + "form"));

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
