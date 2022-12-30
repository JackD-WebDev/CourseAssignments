package JackDaly_Assignment07b;

import java.math.BigDecimal;
import java.util.Scanner;

public class JackDaly_Assignment07b
{
    public static void main(String[] args) {
        Account account1 = new Account("Jane Green", BigDecimal.valueOf(50.00));
        Account account2 = new Account("John Blue", BigDecimal.valueOf(-7.53));

        System.out.printf("%s balance: $%.2f%n",
                account1.getName(), account1.getBalance());
        System.out.printf("%s balance: $%.2f%n%n",
                account2.getName(), account2.getBalance());

        Scanner input = new Scanner(System.in);

        System.out.print("Enter deposit amount for account1: ");
        double depositAmount = input.nextDouble();
        System.out.printf("%n"+"adding %.2f to account1 balance%n%n",
                depositAmount);
        BigDecimal convertedDeposit = BigDecimal.valueOf(depositAmount);
        account1.deposit(convertedDeposit);

        System.out.printf("%s balance: $%.2f%n",
                account1.getName(), account1.getBalance());
        System.out.printf("%s balance: $%.2f%n%n",
                account2.getName(), account2.getBalance());

        System.out.print("Enter deposit amount for account2: ");
        depositAmount = input.nextDouble();
        System.out.printf("%n"+"adding %.2f to account2 balance%n%n",
                depositAmount);
        convertedDeposit = BigDecimal.valueOf(depositAmount);
        account2.deposit(convertedDeposit);

        System.out.printf("%s balance: $%.2f%n",
                account1.getName(), account1.getBalance());
        System.out.printf("%s balance: $%.2f%n%n",
                account2.getName(), account2.getBalance());
    }
}