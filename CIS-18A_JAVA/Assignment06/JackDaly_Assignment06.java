package JackDaly_Assignment06;

import java.util.Scanner;

public class JackDaly_Assignment06
{
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        System.out.print("Enter the month (1 = January, 2 = February, etc.): ");
        int enteredMonth = input.nextInt();

        System.out.print("Enter the year: ");
        int enteredYear = input.nextInt();

        MonthDays month = new MonthDays(enteredMonth);
        int numberOfDays = month.getNumberOfDays(enteredMonth, enteredYear);
        System.out.printf("%d/%d: has %d days.", month.getMonth(), enteredYear, numberOfDays);
    }

}