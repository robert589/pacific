export class System  {
    public static getUserId() {
    }

    public static getBaseUrl() : string {
        return (<HTMLInputElement>document.getElementById('base-url')).value;
    }

    public static isEmptyValue(x : Object) : boolean{
        return x === null || typeof x === 'undefined' || x === '';
    }

    public static capitalizeFirstLetter(text: string) : string {
        return text.charAt(0).toUpperCase() + text.slice(1);
    }


    public static isEmail(text : string ) : boolean {
        let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(text);
    }

    public static addCsrf(data : Object)  {
        let csrfParam : string = System.getCsrfParam();
        let csrfToken : string = System.getCsrfValue();
        data[csrfParam] = csrfToken ;

        return data;
    }

    public static addCsrfToUrl(url : string) {
        let csrfParam : string = System.getCsrfParam();
        let csrfToken : string = System.getCsrfValue();
        return url + "?" + csrfParam + "=" + csrfToken;
    }
 
    public static getCsrfParam() {
        return document.querySelector('meta[name="csrf-param"]').getAttribute('content');
    }

    public static getCsrfValue() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    public static checkIdExist(id : string) {
        return !System.isEmptyValue(document.getElementById(id));
    }

}