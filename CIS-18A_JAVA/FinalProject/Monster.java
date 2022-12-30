package JackDaly_FinalProject;

import java.security.SecureRandom;

public class Monster extends Character implements ActionsInterface {
    public static boolean defending;
    public static int specialCounter;

    public static void resetMonsterDefense() {
        Monster.defending = false;
    }

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

    @Override
    public int attack() {
        if(Player.defending) {
            Player.resetPlayerDefense();
            return (10 + rollDice(6)) / rollDice(1);
        } else return 10 + rollDice(6);
    }

    @Override
    public void defend() {
        Monster.defending = true;
    }

    @Override
    public int heal() {
        return 500 * rollDice(1);
    }

    @Override
    public int special() {
        return rollDice(2) * attack();
    }

    public int logic(int monsterPercentHP) {
        SecureRandom random = new SecureRandom();
        int[] logicArray = new int[6];
        if (monsterPercentHP < 100 && monsterPercentHP >= 70 && Monster.specialCounter == 0) {
            logicArray[0] = 1;
            logicArray[1] = 1;
            logicArray[2] = 1;
            logicArray[3] = 1;
            logicArray[4] = 4;
            logicArray[5] = 4;
        } else if (monsterPercentHP >= 70 && Monster.specialCounter != 0) {
            logicArray[0] = 1;
            logicArray[1] = 1;
            logicArray[2] = 1;
            logicArray[3] = 1;
            logicArray[4] = 1;
            logicArray[5] = 2;
        } else if (monsterPercentHP < 70 && monsterPercentHP >= 50 && Monster.specialCounter == 0) {
            logicArray[0] = 1;
            logicArray[1] = 1;
            logicArray[2] = 1;
            logicArray[3] = 4;
            logicArray[4] = 4;
            logicArray[5] = 4;
        } else if (monsterPercentHP < 70 && monsterPercentHP >= 50) {
            logicArray[0] = 1;
            logicArray[1] = 1;
            logicArray[2] = 1;
            logicArray[3] = 2;
            logicArray[4] = 2;
            logicArray[5] = 2;
        } else if (monsterPercentHP < 50 && monsterPercentHP >= 30 && Monster.specialCounter == 0) {
            logicArray[0] = 1;
            logicArray[1] = 1;
            logicArray[2] = 1;
            logicArray[3] = 2;
            logicArray[4] = 2;
            logicArray[5] = 4;
        } else if (monsterPercentHP < 50 && monsterPercentHP >= 30) {
            logicArray[0] = 1;
            logicArray[1] = 1;
            logicArray[2] = 1;
            logicArray[3] = 1;
            logicArray[4] = 2;
            logicArray[5] = 2;
        } else if (monsterPercentHP < 30 && monsterPercentHP >= 10 && Monster.specialCounter == 0) {
            logicArray[0] = 1;
            logicArray[1] = 2;
            logicArray[2] = 3;
            logicArray[3] = 4;
            logicArray[4] = 4;
            logicArray[5] = 4;
        } else if (monsterPercentHP < 30 && monsterPercentHP >= 10) {
            logicArray[0] = 1;
            logicArray[1] = 1;
            logicArray[2] = 1;
            logicArray[3] = 2;
            logicArray[4] = 2;
            logicArray[5] = 3;
        } else if (monsterPercentHP < 10 && Monster.specialCounter == 0) {
            logicArray[0] = 1;
            logicArray[1] = 2;
            logicArray[2] = 3;
            logicArray[3] = 3;
            logicArray[4] = 4;
            logicArray[5] = 4;
        } else if (monsterPercentHP < 10) {
            logicArray[0] = 1;
            logicArray[1] = 2;
            logicArray[2] = 2;
            logicArray[3] = 3;
            logicArray[4] = 3;
            logicArray[5] = 3;
        } else {
            logicArray[0] = 1;
            logicArray[1] = 1;
            logicArray[2] = 1;
            logicArray[3] = 1;
            logicArray[4] = 1;
            logicArray[5] = 1;
        }
        return logicArray[random.nextInt(6)];
    }
}
