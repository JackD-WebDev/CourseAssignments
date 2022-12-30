package JackDaly_Assignment08;

public class RedDragon extends Dragon {

    String redType = "fire";
    Dragon dragon = new Dragon(redType);

    public RedDragon(String type) {
        super(type);
    }

    public String attack() {
        return "Red Dragon breathes " + dragon.getType();
    }

}