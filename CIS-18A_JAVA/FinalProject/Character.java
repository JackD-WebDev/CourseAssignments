package JackDaly_FinalProject;

import java.security.SecureRandom;

public class Character implements baseInterface {

    private int currentHP;

    public void takeDamage(int hitPoints) {
        this.currentHP -= hitPoints;
        setCurrentHP(this.currentHP);
    }

    public void healDamage(int hitPoints) {
        this.currentHP += hitPoints;
        setCurrentHP(this.currentHP);
    }

    public int rollDice(int xD6) {
        SecureRandom roll = new SecureRandom();
        int result = 0;
        while(xD6 > 0) {
            int face = 1 + roll.nextInt(6);
            result += face;
            --xD6;
        }
        return result;
    }

    public void setCurrentHP(int currentHP) {
        this.currentHP = currentHP;
    }

    public int getCurrentHP() {
        return this.currentHP;
    }
}
