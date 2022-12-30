import java.util.Scanner;

public class JackDaly_Assignment01
{
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        //TODO: implement input validation and error handling (previous attempts unsuccessful 🤷 )

        System.out.print("Enter Month: ");
        String enteredMonth = input.next();
        String month = enteredMonth.substring(0, 1).toUpperCase() + enteredMonth.substring(1).toLowerCase();

        System.out.print("Enter Fiscal Year: ");
        int year = input.nextInt();

        System.out.print("Enter Total Funds Collected: ");
        double totalCollected = input.nextDouble();

        double stateTaxRate = 0.0575;
        double countyTaxRate = 0.0285;

        double stateTax = totalCollected * stateTaxRate;
        double countyTax = totalCollected * countyTaxRate;
        double taxesCollected = totalCollected * (stateTaxRate + countyTaxRate);
        double totalSales = totalCollected - taxesCollected;

        /* I was unable to determine how to derive the input length & set widths dynamically.
        Thus, some of the following values were chosen semi-arbitrarily based on the example */
        System.out.printf("Month: %s %d%n", month, year);
        System.out.println("-------------------------------");
        System.out.printf("%-21s%s %.2f%n", "Total Collected: ", "$", totalCollected);
        System.out.printf("%-21s%s %.2f%n", "Sales: ", "$", totalSales);
        System.out.printf("%-23s%s %.2f%n", "County Sales Tax: ", "$", countyTax);
        System.out.printf("%-22s%s %.2f%n", "State Sales Tax: ", "$", stateTax);
        System.out.printf("%-22s%s %.2f%n", "Total Sales Tax: ", "$", taxesCollected);
    }
}