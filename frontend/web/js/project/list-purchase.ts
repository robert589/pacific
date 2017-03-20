import {Component} from '../common/component';
import {Button} from './../common/button';
import {AddPurchaseForm} from './add-purchase-form';
import {String} from './../common/string'
import {System} from './../common/system';

export class ListPurchase extends Component{

    showformBtn : Button;

    formarea : HTMLElement;

    form : AddPurchaseForm;

    removeBtns : Button[];

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new AddPurchaseForm(document.getElementById(this.id + "-form"));
        this.formarea = <HTMLElement> this.root.getElementsByClassName('list-purchase-formarea')[0];
        this.showformBtn = new Button(document.getElementById(this.id + "-showform"), this.toggleForm.bind(this));

        let removeBtnsRaw : NodeListOf<Element> = this.root.getElementsByClassName('list-purchase-remove');
        this.removeBtns = [];
        for(let  i = 0; i < removeBtnsRaw.length; i++) {
            this.removeBtns.push(new Button(<HTMLElement>removeBtnsRaw.item(i), 
                        this.showRemoveDialog.bind(this, removeBtnsRaw.item(i))));
        }
    }

    showRemoveDialog(raw : HTMLElement) {
        System.showConfirmDialog(this.removePurchase.bind(null, raw)
        , "Are you sure", "Once it is deleted, you will not be able to retrieve it back");        
    }

    removePurchase(raw : HTMLElement) {
        let purchase_id = raw.getAttribute('data-purchase-id');
        let data : Object = {};
        data['purchase_id'] = purchase_id;

        $.ajax({
            url : System.getBaseUrl() + "/purchase/remove",
            data : System.addCsrf(data),
            context : this,
            dataType : "json",
            method  : "post",
            success : function(data) {
                if(data.status) {
                    window.location.reload();
                }
            },
            error : function(data) {
            }
        });
        
    }


    
    toggleForm() {
        let hidden : boolean = this.formarea.classList.contains('app-hide');
        if(hidden) {
            this.showForm();
        }
        else {
            this.hideForm();
        }
    }

    showForm() {
        this.changeShowFormBtnArrowUp(true);
        this.formarea.classList.remove('app-hide')
    }

    changeShowFormBtnArrowUp(up : boolean) {
        let text : string = this.showformBtn.getText();
        if(up) {
            text = String.replaceAll(text, "down", "up");
        } else {
            text = String.replaceAll(text, "up", "down");
        }

        this.showformBtn.setText(text);
    }

    hideForm() {
        this.changeShowFormBtnArrowUp(false);
        this.formarea.classList.add('app-hide');
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
