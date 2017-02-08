import {Component} from './component';
import {Button} from './../common/button';
import {ImageViewModal} from './image-view-modal';

export class ImageView extends Component {

    image : HTMLImageElement;

    modal : ImageViewModal;

    constructor(root : HTMLElement) {
        super(root);
    }

    decorate() {
        super.decorate();
        this.modal = new ImageViewModal(document.getElementById(this.id + "modal"));
        this.image = <HTMLImageElement> document.getElementsByClassName('image-view-img')[0];
    }
    
    bindEvent() {
        super.bindEvent();

        this.image.addEventListener('click', this.showModal.bind(this));
    }

    showModal() {
        this.modal.show();
    }
}