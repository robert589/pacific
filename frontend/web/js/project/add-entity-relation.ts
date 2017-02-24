import {Component} from '../common/component';
import {AddEntityRelationForm} from './add-entity-relation-form';
import {AddEntityRelationRangeForm}  from './add-entity-relation-range-form';

export class AddEntityRelation extends Component{

    aerForm : AddEntityRelationForm;

    aerRangeForm : AddEntityRelationRangeForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.aerForm = new AddEntityRelationForm(document.getElementById(this.id + "-form"));
        this.aerRangeForm = new AddEntityRelationRangeForm(document.getElementById(this.id + "-rform"));    
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
