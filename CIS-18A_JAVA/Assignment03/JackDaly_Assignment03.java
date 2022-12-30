import java.util.Scanner;

public class JackDaly_Assignment03
{
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        int currentDay = 0;
        double totalWages = 0.00;

        System.out.print("For how many days will the pay double (maximum 45): ");
        int daysWorked = input.nextInt();

        if(daysWorked < 1) {
            System.out.print("Number of days worked must be 1 or more. Enter days worked: ");
            daysWorked = input.nextInt();
        }

        if(daysWorked > 45) {
            System.out.print("Number of days worked must be less than 45. Enter days worked: ");
            daysWorked = input.nextInt();
        }

        System.out.printf("%-4s%20s%n", "Days", "Total pay");
        System.out.println("----------------------------------");


        while(currentDay < daysWorked) {
            currentDay++;
            double daysWage = (Math.pow(2, (currentDay - 1)) / 100);
            totalWages = daysWage + totalWages;

            System.out.printf("%-4s%2d  ","Day ", currentDay);
            System.out.printf("%6c%,19.2f%n", '$', daysWage);
        }

        System.out.println("----------------------------------");
        System.out.printf("Total Wages: $ %,.2f", totalWages);
    }
}