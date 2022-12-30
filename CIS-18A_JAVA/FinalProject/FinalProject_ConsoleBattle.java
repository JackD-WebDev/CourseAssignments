package JackDaly_FinalProject;

import java.security.SecureRandom;
import java.util.Scanner;

public class FinalProject_ConsoleBattle
{
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        Action[] actions = Action.values();

        //Initialize Monster
        Monster monster = new Monster();
        monster.setCurrentHP(1000 * monster.rollDice(2));
        final int monsterMaxHP = monster.getCurrentHP();
        final String monsterName = monsterType();
        int monsterPercentHP = 100;

        //Initialize Player
        Player player = new Player();
        player.setCurrentHP(200 + (100 * player.rollDice(2)));
        final int playerMaxHP = player.getCurrentHP();

        //Intro
        System.out.println("You find yourself wandering the");
        System.out.println("forest at night, young knight.");
        System.out.println("Suddenly, from behind the trees");
        System.out.printf("emerges a %s out for BLOOD!", monsterName);
        System.out.println(" ");
        System.out.println("Ready your sword and shield!");
        System.out.println("--------------------------------------");
        System.out.println(" ");

        //Turns
        do {
            if(Player.specialCounter > 0) {
                Player.specialCounter--;
            }
            if(Monster.specialCounter > 0) {
                Monster.specialCounter--;
            }

            //Player's Turn
            System.out.println("-----------CHOOSE AN ACTION-----------");
            for(Action action : Action.values()) {
                System.out.printf("%s[%d] ", action, (1 + action.getAct()));
            }
            boolean continueInput = true;
            do {
                try {
                    System.out.printf("%nACTION: ");
                    int selectedAction = input.nextInt();
                    if (selectedAction == 1) {
                        player.act(actions[selectedAction - 1]);
                        int damage = player.attack();
                        monster.takeDamage(damage);
                        System.out.println("You swing your sword and inflict");
                        System.out.printf("%d damage upon the %s. %n", damage, monsterName);
                        continueInput = false;
                    } else if (selectedAction == 2) {
                        player.act(actions[selectedAction - 1]);
                        player.defend();
                        System.out.println("-----------PLAYER DEFENDING-----------");
                        continueInput = false;
                    } else if (selectedAction == 3) {
                        player.act(actions[selectedAction - 1]);
                        int health = player.heal();
                        player.healDamage(health);
                        if(player.getCurrentHP() > playerMaxHP) {
                            player.setCurrentHP(playerMaxHP);
                        }
                        System.out.print("You drink a healing tonic and%n");
                        if(player.getCurrentHP() == playerMaxHP) {
                            System.out.print("are completely restored!");
                        } else {
                            System.out.printf("restore %dHP.", health);
                        }
                        continueInput = false;
                    } else if (selectedAction == 4 && Player.specialCounter == 0) {
                        player.act(actions[selectedAction - 1]);
                        int damage = player.special();
                        monster.takeDamage(damage);
                        Player.specialCounter = 5;
                        System.out.printf("You unleash a mad flurry of attacks%n");
                        System.out.printf("dealing %d damage to the %s.", damage, monsterName);
                        continueInput = false;
                    } else if (selectedAction == 4 && Player.specialCounter > 0) {
                        input.nextLine();
                        System.out.println("You are too tired to try that.");
                        System.out.println("Your SPECIAL attack will be available");
                        System.out.printf("in %d turns.%n", Player.specialCounter);
                    } else throw new IllegalArgumentException("Invalid Input. Please choose another action.");
                } catch (IllegalArgumentException err) {
                    input.nextLine();
                    err.printStackTrace();
                }
            } while (continueInput);

            //Monster's Turn
            monsterPercentHP = (monsterMaxHP / monster.getCurrentHP());
            int monsterAct = monster.logic(monsterPercentHP);
            System.out.println("-----------MONSTER'S TURN-------------");

            if (monsterAct == 1) {
                monster.act(actions[monsterAct - 1]);
                int damage = monster.attack();
                player.takeDamage(damage);
                System.out.printf("The %s swipes at you, dealing %n", monsterName);
                System.out.printf("%d damage to you. %n", damage);
            } else if (monsterAct == 2) {
                monster.act(actions[monsterAct - 1]);
                monster.defend();
                System.out.println("----------MONSTER DEFENDING-----------");
            } else if (monsterAct == 3) {
                monster.act(actions[monsterAct - 1]);
                int health = monster.heal();
                monster.healDamage(health);
                System.out.printf("The %s heals %dHP. %n", monsterName, health);
            } else {
                monster.act(actions[monsterAct - 1]);
                int damage = monster.special();
                player.takeDamage(damage);
                Monster.specialCounter = 5;
                System.out.printf("The %s catches you in its claws,%n", monsterName);
                System.out.printf("dealing %d damage to you. %n", damage);
            }
            if(player.getCurrentHP() <= 0) {
                System.out.println("YOU DIED! GAME OVER!");
            }
            if(player.getCurrentHP() <= 0) {
                System.out.printf("YOU HAVE SLAIN THE %s! YOU WIN!", monsterName);
            }

            System.out.println("---------HIT POINTS REMAINING---------");
            System.out.println("PLAYER HP: " + player.getCurrentHP());
            System.out.println(monsterName + " HP: " + monster.getCurrentHP());
        } while (0 <= monster.getCurrentHP() && 0 <= player.getCurrentHP());
    }

    public static String monsterType() {
        String[] monsters = {"SKELETON", "DRAGON", "GOBLIN", "ORC", "ZOMBIE"};
        SecureRandom randomMonster = new SecureRandom();
        return monsters[randomMonster.nextInt(5)];
    }

}