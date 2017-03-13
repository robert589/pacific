import {String} from './string';

export class Math {

    public static modulo(value : number, base : number) {
        return ((value % base)+base)% base;

    }
 
    public static safeEval(expr : string) : string {
        try {

            let result : string = math.eval(expr);
            return result;
        }
        catch(e)  {
            return null;
        }
    }

    public static convertToCurrency(text : string) : string{
        return parseFloat(text.replace(/,/g, ""))
                    .toFixed(2)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "";
    }

    public static convertFromCurrency(text : string) : number{
        return parseFloat(String.replaceAll(text, ",", ""));

    }
}