import {Component} from './component';
import {System} from './../common/system';

export abstract class Field extends Component {
    protected fieldError : HTMLElement;
    protected name : string;
    
    constructor(root: HTMLElement) {
        super(root);
    }

    decorate() {
        super.decorate();
        this.fieldError = <HTMLElement> this.root.getElementsByClassName('field-error')[0];
        this.name = this.root.getAttribute('data-name');
    }
    
    showError(errorMessage : string) {
        this.fieldError.innerHTML = errorMessage;
        this.fieldError.classList.remove('app-hide');
    }

    hideError() {
        this.fieldError.classList.add('app-hide');
    }

    getName() : string {
        return this.name;
    }

    getDisplayName() : string {
        let constructedName : string = "";
        let first : boolean = true;
        let piecesOfName : string[] = this.name.split("_");

        for(let piece of piecesOfName) {
            if(first) {
                first = false;
            } else {
                constructedName += " ";
            }
            constructedName += System.capitalizeFirstLetter(piece);
        }
        return constructedName;
    }

    setIndex(index : number) {
        this.root.setAttribute('data-index', index + "");
    }

    getIndex() : number {
        return parseInt(this.root.getAttribute('data-index'));
    }
    
    abstract getValue() : Object;
}