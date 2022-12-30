package JackDaly_Assignment08;

public class BlueDragon extends Dragon {

    String blueType = "ice";
    Dragon dragon = new Dragon(blueType);

    public BlueDragon(String type) {
        super(type);
    }

    public String attack() {
        return "Blue Dragon breathes " + dragon.getType();
    }

}
