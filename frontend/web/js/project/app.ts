import {Component} from '../common/component';
import {Login} from './login';
import {CreateOwner} from './create-owner';
import {ListOwner} from './list-owner';
import {CreateShip} from './create-ship';
import {ListShip} from './list-ship';
import {ShipOwnership} from './ship-ownership';
import {DailyReport} from './daily-report';
import {CustomReport} from './custom-report';

export class App extends Component{

    login : Login;

    createOwner : CreateOwner;

    listOwner : ListOwner;

    createShip : CreateShip;

    listShip : ListShip;

    shipOwnership : ShipOwnership;

    dailyReport : DailyReport;

    customReport : CustomReport;

    leftSide : HTMLElement;

    hamburgerIcon : HTMLElement;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        if(this.root.getElementsByClassName('login').length !== 0) {
            this.login = new Login(document.getElementById("lgn"));
        } 
        else if(this.root.getElementsByClassName('create-owner').length !== 0) {
            this.createOwner = new CreateOwner(document.getElementById("oco"));
        } 
        else if(this.root.getElementsByClassName('list-owner').length !== 0) {
            this.listOwner = new ListOwner(document.getElementById("olo"));
        } 
        else if(this.root.getElementsByClassName('list-ship').length !== 0) {
            this.listShip = new ListShip(document.getElementById("sls"));
        } 
        else if(this.root.getElementsByClassName('create-ship').length !== 0) {
            this.createShip = new CreateShip(document.getElementById("scs"));
        } 
        else if(this.root.getElementsByClassName('ship-owner').length !== 0) {
            this.shipOwnership = new ShipOwnership(document.getElementById("sso"));
        } 
        else if(this.root.getElementsByClassName('daily-report').length !== 0) {
            this.dailyReport = new DailyReport(document.getElementById("rdr"));
        } 
        else if(this.root.getElementsByClassName('custom-report').length !== 0) {
            this.customReport = new CustomReport(document.getElementById("rcr"));
        }
        
        this.hamburgerIcon = <HTMLElement> 
                        this.root.getElementsByClassName('app-hamburger')[0];
        this.leftSide = <HTMLElement> this.root.getElementsByClassName('left-side')[0];
    
    }
    
    toggleLeftSide() {
        if(this.leftSide.classList.contains('app-hide')) {
            this.leftSide.classList.remove('app-hide');
        } else {
            this.leftSide.classList.add('app-hide');
        }
    }

    bindEvent() {
        super.bindEvent();
        this.hamburgerIcon.addEventListener('click', this.toggleLeftSide.bind(this)); 
    
    }
    
    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
