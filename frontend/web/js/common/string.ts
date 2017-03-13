export class String  {
    public static trim(text : string) {
        return text.replace(/^\s+|\s+$/g, "");
    }

    public static replaceAll(text : string, search  : string, replacement : string) : string {
        
        return text.replace(new RegExp(search, 'g'), replacement);
    }
  
    public static numberOfOccurences(char : string, text : string) : number {
        return text.split(char).length-1;
    }
}