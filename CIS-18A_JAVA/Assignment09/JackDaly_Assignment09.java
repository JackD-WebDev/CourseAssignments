package JackDaly_Assignment09;

import java.util.Scanner;

public class JackDaly_Assignment09
{
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        int hours;

        //initialize goats
        Goats goats = new Goats();
        goats.setCurrentWaterLevel(500);
        goats.setCurrentFeedLevel(1000);

        //initialize tomatoes
        Tomatoes tomatoes = new Tomatoes();
        tomatoes.setGallonsPerHour(1500);
        tomatoes.setCurrentAdmixLevel(200);

        System.out.print("Run automated food and water simulation for how many hours?: ");
        hours = input.nextInt();
        while (hours > 0) {
            goats.simulateGoats();
            System.out.printf("Current water level in goat pen filtration system: %d gallons%n", goats.getCurrentWaterLevel());
            System.out.printf("Current amount of feed in goat trough: %d pounds%n%n", goats.getCurrentFeedLevel());

            tomatoes.simulateTomatoes();
            System.out.printf("Current gallons of water in tomato irrigation system: %d gallons%n", goats.getCurrentWaterLevel());
            System.out.printf("Current amount of admix in tomato irrigation lines: %d pounds%n%n", goats.getCurrentFeedLevel());

            hours--;
        }

    }
}