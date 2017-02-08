export class String  {
    public static trim(text : string) {
        return text.replace(/^\s+|\s+$/g, "");
    }
  
}