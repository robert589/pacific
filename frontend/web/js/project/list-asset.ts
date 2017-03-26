import {Component} from '../common/component';
import {AddAssetFormModal} from './add-asset-form-modal';
import {Button} from './../common/button';

export class ListAsset extends Component{

    asfModal : AddAssetFormModal;

    triggerAsfModalBtn : Button;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.asfModal = new AddAssetFormModal(document.getElementById(this.id + "-modal"));    
        this.triggerAsfModalBtn = new Button(document.getElementById(this.id + "-triggerasf-modal"),
                                        this.triggerAsfModal.bind(this));
    }
    
    triggerAsfModal() {
        this.asfModal.show();
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
