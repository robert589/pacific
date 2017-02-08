export abstract class Component {
    protected root : HTMLElement;
    
    protected id : string;

    constructor(root : HTMLElement) {
        this.root = root;
        this.decorate();
        this.bindEvent();
    }
    decorate() {
        this.id = this.root.getAttribute('id');
    }

    bindEvent() {

    }
    detach() {

    }
    
    /**
     * Remove completely
     */
    remove() {
        this.detach();
        this.root.parentElement.removeChild(this.root);
    }

    unbindEvent() {

    }
   
    deconstruct() {
        this.detach();
        this.unbindEvent();
    }

    getRoot() {
        return this.root;
    }

    removeClass(className : string) {
        this.root.classList.remove(className);
    }

    addClass(className : string) {
        this.root.classList.add(className);
    }

    attachEvent(eventName : string, callback: EventListener) {
        this.root.addEventListener(eventName, callback);
    }
}



