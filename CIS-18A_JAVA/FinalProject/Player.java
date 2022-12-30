package JackDaly_FinalProject;

public class Player extends Character implements ActionsInterface {
    public static boolean defending;
    public static int specialCounter;


    public void act(Action action) {
        try {
            if(action == Action.ATTACK) {
                attack();
            } else if(action == Action.DEFEND) {
                defend();
            } else if(action == Action.HEAL) {
                heal();
            } else if(action == Action.SPECIAL) {
                special();
            } else {
                throw new IllegalArgumentException("Invalid action.");
            }
        } catch (IllegalArgumentException err) {
            err.printStackTrace();
        }
    }

    public static void resetPlayerDefense() {
        Player.defending = false;
    }

    @Override
    public int attack() {
        if(Monster.defending) {
            Monster.resetMonsterDefense();
            return (100 + (10 * rollDice(3))) / rollDice(1);
        } else {
            return 100 + (10 * rollDice(3));
        }
    }

    @Override
    public void defend() {
        Player.defending = true;
    }

    @Override
    public int heal() {
        return 50 * rollDice(1);
    }

    @Override
    public int special() {
        return rollDice(1) * attack();
    }
}
