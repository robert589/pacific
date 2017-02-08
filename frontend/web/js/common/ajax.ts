export class Ajax {
    public static get GET():string { return "GET"; }

    public static get POST():string { return "POST"; }

    xmlHttpRequest : XMLHttpRequest;

    url : string;

    type: string;

    constructor(url : string, type : string, successCb : Function, failCb : Function ) {
        this.xmlHttpRequest = new XMLHttpRequest();
        this.url = url;
        this.type = type;

        this.xmlHttpRequest.onreadystatechange = function(e : EventTarget) {
            if (this.xmlHttpRequest.readyState == XMLHttpRequest.DONE ) {
                if (this.xmlHttpRequest.status == 200) {
                    successCb();
                }
                else {
                    failCb();
                }
            } else {
                return false;
            }
        }.bind(this);

    }


    public send(data : FormData): void{
        this.xmlHttpRequest.open(this.type, this.url, true);
        this.xmlHttpRequest.send(data);
    }


}