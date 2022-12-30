package JackDaly_Assignment08;

public class JackDaly_Assignment08
{
    public static void main(String[] args) {

        RedDragon redDragonAttack = new RedDragon("fire");
        System.out.println(redDragonAttack.attack());

        BlueDragon blueDragonAttack = new BlueDragon("ice");
        System.out.println(blueDragonAttack.attack());

    }
}