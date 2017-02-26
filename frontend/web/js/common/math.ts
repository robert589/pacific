export class Math {

    public static modulo(value : number, base : number) {
        return ((value % base)+base)% base;

    }
}