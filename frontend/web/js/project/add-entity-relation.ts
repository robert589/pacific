import {Component} from '../common/component';
import {AddEntityRelationForm} from './add-entity-relation-form';
import {AddEntityRelationRangeForm}  from './add-entity-relation-range-form';
import {Button} from './../common/button';
import {System} from './../common/system';

export class AddEntityRelation extends Component{

    aerForm : AddEntityRelationForm;

    aerRangeForm : AddEntityRelationRangeForm;
    
    removeRelationBtns : Button[];

    removeAllRelationBtn : Button;

    codeId : string;

    constructor(root: HTMLElement) {
        super(root);
        this.codeId = this.root.getAttribute('data-code-id');
    }
    
    decorate() {
        super.decorate();
        this.aerForm = new AddEntityRelationForm(document.getElementById(this.id + "-form"));
        this.aerRangeForm = new AddEntityRelationRangeForm(document.getElementById(this.id + "-rform"));    
        let removeRelationsRaw : NodeListOf<Element> = this.root.getElementsByClassName('aer-remove');

        this.removeRelationBtns = [];
        for(let i = 0 ; i < removeRelationsRaw.length; i++) {
            this.removeRelationBtns.push(new Button(<HTMLElement>removeRelationsRaw.item(i), 
                                    this.showRemoveRelationDialog.bind(this, removeRelationsRaw.item(i))));
        }

        this.removeAllRelationBtn = new Button(document.getElementById(this.id + "-remove-all"),
                                    this.showRemoveAllRelationDialog.bind(this));

    }
    
    showRemoveAllRelationDialog() {
        System.showConfirmDialog(this.removeAllRelation.bind(this)
        , "Hapus Semua Subkode", "Apakah anda yakin?");  
    }

    showRemoveRelationDialog(raw : HTMLElement) {
        System.showConfirmDialog(this.removeRelation.bind(this, raw)
        , "Hapus Subkode", "Apakah anda yakin?");        
    
    }

    removeAllRelation() {
        let data = {};
        data['code'] = this.codeId;

        $.ajax({
            url : System.getBaseUrl()  + "/code/remove-all-relation",
            data : System.addCsrf(data),
            dataType : "json",
            context : this,
            method : "post",
            success : function(data) {
                window.location.reload();
            },
            error : function(data) {

            }      
        })
    }

    removeRelation(removeRelationRaw : HTMLElement) {
        let subcodeId : string = removeRelationRaw.getAttribute('data-entity-id');

        let data = {};
        data['subcode'] = subcodeId;
        data['code'] = this.codeId;

        $.ajax({
            url : System.getBaseUrl()  + "/code/remove-relation",
            data : System.addCsrf(data),
            dataType : "json",
            context : this,
            method : "post",
            success : function(data) {
                window.location.reload();
            },
            error : function(data) {

            }      
        })
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
