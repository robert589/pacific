import {Component} from '../common/component';
import {Login} from './login';
import {CreateOwner} from './create-owner';
import {ListOwner} from './list-owner';
import {CreateShip} from './create-ship';
import {ListShip} from './list-ship';
import {ShipOwnership} from './ship-ownership';
import {DailyReport} from './daily-report';
import {CustomReport} from './custom-report';
import {System} from './../common/system';
import {DailySelling} from './daily-selling';
import {CustomSelling} from './custom-selling';
import {ListCode} from './list-code';
import {ListCodeType} from './list-code-type';
import {CreateCodeType} from './create-code-type';
import {CreateCode} from './create-code';
import {DailyTransaction} from './daily-transaction';
import {CustomTransaction} from './custom-transaction';
import {ChangePassword} from './change-password';
import {AssignCodeToShip} from './assign-code-to-ship';
import {EditShip} from './edit-ship';
import {AddEntityRelation} from './add-entity-relation';
import {EditCode} from './edit-code';
import {EditCodeType} from './edit-code-type';

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

    dailySelling : DailySelling;

    customSelling : CustomSelling;

    listCode : ListCode;

    listCodeType : ListCodeType;

    createCodeType : CreateCodeType;

    createCode : CreateCode;

    editCode : EditCode;

    dailyTransact : DailyTransaction;

    customTransact : CustomTransaction;

    changePassword : ChangePassword;

    actShip : AssignCodeToShip;

    editShip  :EditShip;

    addEntityRelation : AddEntityRelation;

    editCodeType : EditCodeType;

    constructor(root: HTMLElement) {
        super(root);
        if(window.innerWidth < 600) { 
            this.leftSide.classList.add('app-hide');
        }
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
        else if(this.root.getElementsByClassName('daily-selling').length !== 0) {
            this.dailySelling = new DailySelling(document.getElementById("sds"));
        }
        else if(this.root.getElementsByClassName('daily-transact').length !== 0) {
            this.dailyTransact = new DailyTransaction(document.getElementById("tdt"));
        }
        else if(this.root.getElementsByClassName('custom-selling').length !== 0) {
            this.customSelling = new CustomSelling(document.getElementById("scs"));
        }
        else if(this.root.getElementsByClassName('list-code').length !== 0) {
            this.listCode = new ListCode(document.getElementById("clc"));
        }
        else if(this.root.getElementsByClassName('list-code-type').length !== 0) {
            this.listCodeType = new ListCodeType(document.getElementById("clct"));
        }
        else if(this.root.getElementsByClassName('create-codetype').length !== 0) {
            this.createCodeType = new CreateCodeType(document.getElementById("ccct"));
        }
        else if(this.root.getElementsByClassName('create-code').length !== 0) {
            this.createCode = new CreateCode(document.getElementById("ccc"));
        }
        else if(this.root.getElementsByClassName('edit-code').length !== 0) {
            this.editCode = new EditCode(document.getElementById("cec"));
        }
        else if(this.root.getElementsByClassName('edit-code-type').length !== 0) {
            this.editCodeType = new EditCodeType(document.getElementById("cect"));
        }
        else if(this.root.getElementsByClassName('custom-transaction').length !== 0) {
            this.customTransact = new CustomTransaction(document.getElementById("tct"));
        }
        else if(this.root.getElementsByClassName('change-pass').length !== 0) {
            this.changePassword = new ChangePassword(document.getElementById("ucp"));
        }
        else if(this.root.getElementsByClassName('act-ship').length !== 0) {
            this.actShip = new AssignCodeToShip(document.getElementById("sacts"));
        }
        else if(this.root.getElementsByClassName('edit-ship').length !== 0) {
            this.editShip = new EditShip(document.getElementById("ses"));
        }
        else if(this.root.getElementsByClassName('aer').length !== 0) {
            this.addEntityRelation = new AddEntityRelation(document.getElementById("caer"));
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
        if(!System.isEmptyValue(this.hamburgerIcon)) {
            this.hamburgerIcon.addEventListener('click', this.toggleLeftSide.bind(this)); 
        }
        
    }
    
    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
