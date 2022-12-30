package JackDaly_Assignment10;

import java.util.Scanner;

public class JackDaly_Assignment10
{
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        int year;

        System.out.print("Enter the month (1 = January, 2 = February, etc.): ");
        int enteredMonth = input.nextInt();

        System.out.print("Enter the year: ");
        int enteredYear = input.nextInt();
        try {
            if(enteredYear >= 1970 && enteredYear <= 2022) {
                year = enteredYear;
            } else {
                throw new IllegalArgumentException("Year must be between 1970 and the current year. ");
            }
        } catch(IllegalArgumentException err) {
            err.printStackTrace();
            System.out.println();
            System.out.print("Please choose another year: ");
            year = input.nextInt();
        }

        MonthDays month = new MonthDays(enteredMonth);
        int numberOfDays = month.getNumberOfDays(enteredMonth, year);
        System.out.printf("%d/%d: has %d days.", month.getMonth(), year, numberOfDays);
    }
}